<?php

namespace App\Http\Controllers;

use App\Models\MerchantOrder;
use App\Models\OrderLog;
use App\Models\OrderTransaction;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Paystack;

class PaymentController extends Controller
{

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway()
    {
        try{
            return Paystack::getAuthorizationUrl()->redirectNow();
        }catch(\Exception $e) {
//            dd($e->getMessage());
           $test = preg_replace("/[\r\n]*/","",$e->getMessage());

//           dd($e->getCode() );
//            dd( (json_decode(json_encode($test))) );
//            dd(json_encode(json_encode(json_encode($e->getMessage()))));
//            if($e->getCode() == 403){
//                return Redirect::back()->with('error','Currency not supported by merchant.');
//            }
            return Redirect::back()->with('error','The paystack token has expired. Please refresh the page and try again.');
        }
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();
        $paymentDetails = json_decode(json_encode($paymentDetails));

        if(isset($paymentDetails) && $paymentDetails->status){
                if(isset($paymentDetails->data) && $paymentDetails->data->status == "success"){
                    $order = MerchantOrder::where('id',$paymentDetails->data->metadata->order_id)->firstOrfail();
                    $order->paid = 1;
                    $order->status = 'Paid';
                    $order->save();
                    $order_log = new OrderLog();
                    $order_log->message = "An amount of " . ($order->cost_to_pay + $order->shipping_price) ." ". \App\Helpers\AppHelper::currency()." has been processed successfully by ".$paymentDetails->data->channel." on " . now();
                    $order_log->status = "Order Paid";
                    $order_log->merchant_order_id = $order->id;
                    $order_log->save();
                    /**
                     * Save the payment back response in order Transaction
                     *
                     */
                    $order_trans = new OrderTransaction();
                    $order_trans->response = json_encode($paymentDetails->data);
                    $order_trans->merchant_order_id = $order->id;
                    $order_trans->shop_id = $order->shop_id;
                    $order_trans->user_id = $order->user_id;
                    $order_trans->save();
                    return redirect()->route('store.order.detail',$order->id)->with('success','Order paid successfully');

                }
                else{
                    return redirect()->back()->with('error','Unexpected error found');
                }
        }
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }
}

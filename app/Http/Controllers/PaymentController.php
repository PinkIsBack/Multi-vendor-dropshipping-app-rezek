<?php

namespace App\Http\Controllers;

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

        dd($paymentDetails);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }
}

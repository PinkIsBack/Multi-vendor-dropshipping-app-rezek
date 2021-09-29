<?php
namespace App\Http\Controllers;

use App\Models\Finance;
use App\Models\FinanceLog;
use Illuminate\Http\Request;

class HelperController extends Controller
{


    public function finance_log($order = null,$finance =null,$status,$description = null,$tracking = null){
     $title = '';
        if($status == 1){
            $title = "Order Paid";
            $description = "Order ".$order->admin_shopify_name." has been paid amount of ".$order->supplier_pay." USD at ".now();
        }
        if($status == 2){
            $title = "Order fulfilled";
            $description = "Order ".$order->admin_shopify_name." has been fulfilled at ".now();
        }
        if($status == 3){
            $title = "Shipping Charges Added";
            $description = "Order ".$order->admin_shopify_name." has been shipped with amount of ".$tracking->cost.' USD';
        }
        if($status == 4){
            $title = "Shipping Updated";
            $description = "Shipping amount set as ".$tracking->cost_shipping.' USD at '.now();
        }
        if($status == 5){
            $title = "Admin Paid";
            $description = "Order ".$order->admin_shopify_name." has been paid by Admin at ".now();
        }
        $log = new FinanceLog();
        $log->title = $title;
        $log->description = $description;
        $log->order_id = $order->id;
        $log->finance_id = $finance->id;
        $log->save();

    }
}

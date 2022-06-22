<?php namespace App\Jobs;

use App\Models\ErrorLog;
use App\Models\MerchantCustomer;
use App\Models\MerchantLineItems;
use App\Models\MerchantOrder;
use App\Models\MerchantProduct;
use App\Models\MerchantVariant;
use App\Models\OrderFulfillment;
use App\Models\OrderLog;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Osiset\ShopifyApp\Objects\Values\ShopDomain;
use stdClass;

class OrdersCreateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Shop's myshopify domain
     *
     * @var ShopDomain|string
     */
    public $shopDomain;

    /**
     * The webhook data
     *
     * @var object
     */
    public $data;

    /**
     * Create a new job instance.
     *
     * @param string   $shopDomain The shop's myshopify domain.
     * @param stdClass $data       The webhook data (JSON decoded).
     *
     * @return void
     */
    public function __construct($shopDomain, $data)
    {
        $this->shopDomain = $shopDomain;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        try{
        // Convert domain
        $this->shopDomain = ShopDomain::fromNative($this->shopDomain);


            $shop = User::where('name', $this->shopDomain->toNative())->first();

                    $order = $this->data;
                    $product_ids = [];
                    $variant_ids = [];
                    foreach ($order->line_items as $item) {
                        array_push($variant_ids, $item->variant_id);
                        array_push($product_ids, $item->product_id);
                    }
                    if (MerchantProduct::whereIn('shopify_id', $product_ids)->exists()) {
                        if(!MerchantOrder::where('shopify_order_id', $order->id)->exists()) {
                            $new = new MerchantOrder();
                            $new->shopify_order_id = $order->id;
                            $new->email = $order->email;
                            $new->phone = $order->phone;
                            $new->shopify_created_at = date_create($order->created_at)->format('Y-m-d h:i:s');
                            $new->shopify_updated_at = date_create($order->updated_at)->format('Y-m-d h:i:s');
                            $new->note = $order->note;
                            $new->financial_status = $order->financial_status;
                            $new->name = $order->name;
                            $new->total_price = $order->total_price;
                            $new->subtotal_price = $order->subtotal_price;
                            $new->total_weight = $order->total_weight;
                            $new->taxes_included = $order->taxes_included;
                            $new->total_tax = $order->total_tax;
                            $new->currency = $order->currency;
                            $new->total_discounts = $order->total_discounts;
                            if (isset($order->customer)) {
                                if (MerchantCustomer::where('customer_shopify_id', $order->customer->id)->exists()) {
                                    $customer = MerchantCustomer::where('customer_shopify_id', $order->customer->id)->first();
                                    $new->customer_id = $customer->id;
                                } else {
                                    $customer = new MerchantCustomer();
                                    $customer->customer_shopify_id = $order->customer->id;
                                    $customer->first_name = $order->customer->first_name;
                                    $customer->last_name = $order->customer->last_name;
                                    $customer->phone = $order->customer->phone;
                                    $customer->email = $order->customer->email;
                                    $customer->total_spent = $order->customer->total_spent;
                                    $customer->shop_id = $shop->id;
                                    $customer->save();
                                    $new->customer_id = $customer->id;
                                }
                                $new->customer = json_encode($order->customer, true);
                            }
                            if (isset($order->shipping_address)) {
                                $new->shipping_address = json_encode($order->shipping_address, true);
                            }
                            if (isset($order->billing_address)) {
                                $new->billing_address = json_encode($order->billing_address, true);
                            }

                            $new->status = 'new';
                            $new->shop_id = $shop->id;

                            $new->fulfilled_by = 'ZADropship';
                            $new->sync_status = 1;
                            $new->save();

                            $new->admin_shopify_name = 'ZA'.$new->id;
                            $new->save();

                            $cost_to_pay = 0;
                            $supplier_to_pay = 0;

                            foreach ($order->line_items as $item) {
                                $new_line = new MerchantLineItems();
                                $new_line->merchant_order_id = $new->id;
                                $new_line->merchant_product_variant_id = $item->id;
                                $new_line->shopify_product_id = $item->product_id;
                                $new_line->shopify_variant_id = $item->variant_id;
                                $new_line->title = $item->title;
                                $new_line->quantity = $item->quantity;
                                $new_line->sku = $item->sku;
                                $new_line->variant_title = $item->variant_title;
                                $new_line->title = $item->title;
                                $new_line->vendor = $item->vendor;
                                $new_line->price = $item->price;
                                $new_line->requires_shipping = $item->requires_shipping;
                                $new_line->taxable = $item->taxable;
                                $new_line->name = $item->name;
                                $new_line->properties = json_encode($item->properties, true);
                                $new_line->fulfillable_quantity = $item->fulfillable_quantity;
                                $new_line->fulfillment_status = $item->fulfillment_status;

                                $merchant_product = MerchantProduct::where('shopify_id', $item->product_id)->where('toShopify',1)->first();
                                if ($merchant_product != null) {
                                    $new_line->fulfilled_by = $merchant_product->fulfilled_by;
                                    $new_line->linked_product_id = $merchant_product->id;


                                    $new_line->supplier_id = $merchant_product->supplier_id;
                                    $new_line->margin =  $merchant_product->margin;


                                } else {
                                    $new_line->fulfilled_by = 'store';
                                }

                                if ($merchant_product != null) {
                                    $related_variant = MerchantVariant::where('shopify_id', $item->variant_id)->first();
                                    if ($related_variant != null) {

                                        $new_line->linked_variant_id = $related_variant->id;
                                        $new_line->supplier_price = $related_variant->supplier_price;
                                        $new_line->cost = $related_variant->cost;
                                        $supplier_to_pay = $supplier_to_pay + $related_variant->supplier_price * $item->quantity;
                                        $cost_to_pay = $cost_to_pay + $related_variant->cost * $item->quantity;
                                    } else {
                                        $new_line->cost = $merchant_product->cost;
                                        $new_line->supplier_price = $merchant_product->supplier_price;
                                        $supplier_to_pay = $supplier_to_pay + $merchant_product->supplier_price * $item->quantity;
                                        $cost_to_pay = $cost_to_pay + $merchant_product->cost * $item->quantity;
                                    }
                                }

                                $new_line->save();
                            }
                            $new->cost_to_pay = $cost_to_pay;
                            $new->supplier_price = $supplier_to_pay;
                            $new->commission = $cost_to_pay - $supplier_to_pay;

                            $customer = json_decode($new->customer);
                            $billing = json_decode($new->billing_address);
                            $shipping = json_decode($new->shipping_address);
                            if($shipping != null){
                                if(strtolower($shipping->city) == 'johannesburg' || strtolower($shipping->city) == 'pretoria'){
                                    $shipping_price = 59;
                                }
                                else{
                                    $shipping_price = 99;
                                }
                            }
                            elseif ($billing != null){
                                if(strtolower($billing->city) == 'johannesburg' || strtolower($billing->city) == 'pretoria'){
                                    $shipping_price = 59;
                                }
                                else{
                                    $shipping_price = 99;
                                }
                            }
                            $new->shipping_price = $shipping_price;
                            $new->save();

                            if (isset($order->shipping_address)) {
                                $total_weight = 0;
                                $country = $order->shipping_address->country;
                                foreach ($new->line_items as $v) {
                                    if($v->linked_product != null){
                                        if($v->linked_product->linked_product != null) {
                                            $total_weight = $total_weight + ( $v->linked_product->linked_product->weight *  $v->quantity);
                                        }
                                    }
                                }

//                            $zoneQuery = Zone::query();
//                            $zoneQuery->whereHas('has_countries', function ($q) use ($country) {
//                                $q->where('name', 'LIKE', '%' . $country . '%');
//                            });
//                            $zoneQuery = $zoneQuery->pluck('id')->toArray();
//
//                            $shipping_rates = ShippingRate::whereIn('zone_id', $zoneQuery)->newQuery();
//                            $shipping_rates = $shipping_rates->first();
//                            if ($shipping_rates != null) {
//                                if ($shipping_rates->type == 'flat') {
//                                    $new->shipping_price = $shipping_rates->shipping_price;
//                                    $new->total_price = $new->total_price + $shipping_rates->shipping_price;
//                                    $new->cost_to_pay = $new->cost_to_pay + $shipping_rates->shipping_price;
//                                    $new->save();
//                                } else {
//                                    if ($shipping_rates->min > 0) {
//                                        $ratio = $total_weight / $shipping_rates->min;
//                                        $shipping_price = $shipping_rates->shipping_price * $ratio;
//                                        $new->shipping_price = $shipping_price;
//                                        $new->total_price = $new->total_price + $shipping_price;
//                                        $new->cost_to_pay = $new->cost_to_pay + $shipping_price;
//                                        $new->save();
//                                    } else {
//                                        $new->shipping_price = 0;
//                                        $new->save();
//                                    }
//                                }
//
//                            } else {
//                                $new->shipping_price = 0;
//                                $new->save();
//                            }
                            }

                            if (count($order->fulfillments) > 0) {
                                foreach ($order->fulfillments as $fulfillment) {
                                    if ($fulfillment->status != 'cancelled') {
                                        foreach ($fulfillment->line_items as $item) {
                                            $line_item = MerchantLineItems::where('merchant_product_variant_id', $item->id)->first();
                                            if ($line_item != null) {
                                                if ($item->fulfillable_quantity == 0) {
                                                    $line_item->fulfillment_status = 'fulfilled';
                                                    $line_item->fulfillable_quantity = 0;
                                                    $line_item->save();
                                                } else {
                                                    $line_item->fulfillment_status = 'partially-fulfilled';
                                                    $line_item->fulfillable_quantity = $line_item->fulfillable_quantity - $item->fulfillable_quantity;
                                                    $line_item->save();
                                                }
                                            }
                                        }
                                        $new_fulfillment = new OrderFulfillment();
                                        $new_fulfillment->fulfillment_shopify_id = $fulfillment->id;
                                        $new_fulfillment->name = $fulfillment->name;
                                        $new_fulfillment->merchant_order_id = $new->id;
                                        $new_fulfillment->status = 'fulfilled';
                                        $new_fulfillment->save();

                                        $order_log = new OrderLog();
                                        $order_log->message = "A fulfillment named " . $new_fulfillment->name . " has been processed successfully on " . date_create($new_fulfillment->created_at)->format('d M, Y h:i a');
                                        $order_log->status = "Fulfillment";
                                        $order_log->merchant_order_id = $new->id;
                                        $order_log->save();
                                        foreach ($fulfillment->line_items as $item) {
                                            $line_item = MerchantLineItems::where('merchant_product_variant_id', $item->id)->first();
                                            if ($line_item != null) {
                                                $fulfillment_line_item = new MerchantLineItems();
                                                if ($item->fulfillable_quantity == 0) {
                                                    $fulfillment_line_item->fulfilled_quantity = $line_item->quantity;
                                                } else {
                                                    $fulfillment_line_item->fulfilled_quantity = $item->fulfillable_quantity;
                                                }
                                                $fulfillment_line_item->order_fulfillment_id = $new_fulfillment->id;
                                                $fulfillment_line_item->order_line_item_id = $line_item->id;
                                                $fulfillment_line_item->save();
                                            }
                                        }

                                    }
                                }
                            }
                            $new->status = $new->getStatus($new);
                            $new->save();

                            /*Maintaining Log*/
                            $order_log = new OrderLog();
                            $order_log->message = "Order synced to Zadropship on " . date_create($new->created_at)->format('d M, Y h:i a');
                            $order_log->status = "Newly Synced";
                            $order_log->merchant_order_id = $new->id;
                            $order_log->save();

                            /* Auto Order Payment in case user has enabled settings for it */
//                        if($new->financial_status == 'paid')
//                            $this->admin->make_auto_payment($new);
                        }

                    }
        }
        catch (\Exception $x){
            $error_log = new ErrorLog();
            $error_log->title = "Webhook failure";
            $error_log->event = "order create";
            $error_log->response = "Error: ".$x->getMessage();
            $error_log->save();

        }



        // Do what you wish with the data
        // Access domain name as $this->shopDomain->toNative()
    }
}

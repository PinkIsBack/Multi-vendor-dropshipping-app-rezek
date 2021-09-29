<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use App\Models\FulfillmentLineItem;
use App\Models\MerchantLineItems;
use App\Models\MerchantOrder;
use App\Models\OrderFulfillment;
use App\Models\OrderLog;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Osiset\BasicShopifyAPI\BasicShopifyAPI;
use Osiset\BasicShopifyAPI\Options;
use Osiset\BasicShopifyAPI\Session;

/**
 *
 */
class SupplierOrderController extends Controller
{
    private $log;
    public function __construct()
    {
        $this->log = new HelperController();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request){


        $orders = MerchantOrder::where('paid', 1)->has('supplier_line_item')->newQuery();
        if ($request->has('search')) {
            $orders->where('name', 'LIKE', '%' . $request->input('search') . '%');
        }

        if ($request->has('unpaid')) {
            $orders->where('paid', 0);
        }
        if ($request->has('unfulfilled')) {
            $orders->where('status', 'unfulfilled');
        }
        if ($request->has('cancel')) {
            $orders->where('status', 'cancelled');
        }

        $orders = $orders->orderBy('name', 'DESC')->paginate(30);
        return view('supplier.orders.index')->with([
            'orders' => $orders,
            'search' => $request->input('search')
        ]);
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|void
     */
    public function detail($id)
    {

        $order = MerchantOrder::find($id);
        if ($order != null) {
            return view('supplier.orders.detail')->with([
                'order' => $order
            ]);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|void
     */
    public function fulfill_order($id)
    {
        $order = MerchantOrder::find($id);
        if ($order != null) {
            if ($order->paid == 1) {
                return view('supplier.orders.fulfillment')->with([
                    'order' => $order
                ]);
            } else {
                return redirect()->back()->with('error', 'Refunded Order Cant Be Processed Fulfillment');
            }

        }
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function fulfillment_order(Request $request, $id)
    {
        $track = new OrderTrackingController();
        $track->store($request);

        $order = MerchantOrder::find($id);
        if($order->line_items->where('supplier_id','!=',Auth::user()->id)->where('is_supplier_fulfill',0)->count() != 0){

           $items = $order->supplier_line_item;
           foreach ($items as $item){

               $item->is_supplier_fulfill = 1;
               $item->save();
           }
          $finance = Finance::updateOrCreate([
                'order_id'=>$order->id,
                'supplier_id' => Auth::user()->id
            ],[
                'order_id'=>$order->id,
                'supplier_id' => Auth::user()->id,
                'no_products' => count($order->supplier_line_item),
                'cost_products' => $order->supplier_pay,
                'cost_shipping' => $request->cost,
//                'paid_at' => now()

        ]);

           $this->log->finance_log($order,$finance,1);
           $this->log->finance_log($order,$finance,2);
           $this->log->finance_log($order,$finance,3,null,$request);

            return redirect()->route('supplier.order.detail',$order->id)->with('success','Order fulfilled successfully');

        }
        $items = $order->line_items;
        foreach ($items as $item){

            $item->is_supplier_fulfill = 1;
            $item->save();
        }




        if ($order != null) {
            if ($order->paid == 1) {
                    $items = $order->line_items;
                    $fulfillable_quantities =[];
                    foreach ($items as $item){

                        array_push($fulfillable_quantities,$item->fulfillable_quantity);
                }
//                $fulfillable_quantities = $request->input('item_fulfill_quantity');
          if ($order->custom == 0) {
                    $supplier  = Auth::user();

                    $shop = User::where('id',$order->shop_id)->firstOrfail();
                    $shopify_fulfillment = null;

              $options = new Options();
              $options->setVersion('2020-01');
              $api = new BasicShopifyAPI($options);
              $api->setSession(new Session($shop->name, $shop->password));

                    if ($shop != null) {
                        $location_response = $api->rest('GET', '/admin/locations.json');
                        $location_response = json_decode(json_encode($location_response));
                        if (!$location_response->errors) {
                            foreach ($location_response->body->locations as $location) {
                                if ($location->name == "ZADropship") {
                                    $data = [
                                        "fulfillment" => [
                                            "location_id" => $location->id,
                                            "tracking_number" => null,
                                            "notify_customer" => false,
                                            "line_items" => [
                                            ]
                                        ]
                                    ];
                                }
                            }

                            foreach ($order->line_items as $index => $item) {
                                $line_item = MerchantLineItems::find($item->id);
//                                return $data['fulfillment']['line_items'];
                                if ($line_item != null && $fulfillable_quantities[$index] > 0) {
                                    array_push($data['fulfillment']['line_items'], [
                                        "id" => $line_item->merchant_product_variant_id,
                                        "quantity" => $fulfillable_quantities[$index],
                                    ]);
                                }
                            }

                            $response = $api->rest('POST', '/admin/orders/' . $order->shopify_order_id . '/fulfillments.json', $data);
                            $response = json_decode(json_encode($response));
                            if ($response->errors) {
                                if(strpos($response->body->base[0], "already fulfilled") !== false){
                                    $res = $api->rest('GET', '/admin/orders/' . $order->shopify_order_id . '/fulfillments.json');
                                    $res = json_decode(json_encode($res));
                                    return $this->set_fulfilments_for_already_fulfilled_order($request, $id, $fulfillable_quantities, $order, $res);
                                }
                                return redirect()->back()->with('error', 'Cant Fulfill Items of Order in Related Store!');
                            } else {
                                $finance =  Finance::updateOrCreate([
                                    'order_id'=>$order->id,
                                    'supplier_id' => Auth::user()->id
                                ],[
                                    'order_id'=>$order->id,
                                    'supplier_id' => Auth::user()->id,
                                    'no_products' => count($order->supplier_line_item),
                                    'cost_products' => $order->supplier_pay,
                                    'cost_shipping' => $request->cost,
                                    'paid_at' => now()

                                ]);
                                $this->log->finance_log($order,$finance,1);
                                $this->log->finance_log($order,$finance,2);
                                $this->log->finance_log($order,$finance,3,null,$request);

                                return $this->set_fulfilments($request, $id, $fulfillable_quantities, $order, $response);
                            }
                        } else {
                            return redirect()->back()->with('error', 'Cant Fulfill Item Cause Related Store Dont have Location Stored!');
                        }
                    } else {
                        return redirect()->back()->with('error', 'Order Related Store Not Found');
                    }
                }

                else {
                    return $this->set_fulfilments($request, $id, $fulfillable_quantities, $order, '');
                }
            } else {
                return redirect()->back()->with('error', 'Refunded Order Cant Be Processed Fulfillment');
            }
        } else {
            return redirect()->route('admin.order')->with('error', 'Order Not Found To Process Fulfillment');
        }

    }

    public function set_fulfilments_for_already_fulfilled_order(Request $request, $id, $fulfillable_quantities, $order, $response): RedirectResponse
    {
        foreach ($order->line_items as $index => $item) {
            $line_item = MerchantLineItems::find($item->id);
            if ($line_item != null && $fulfillable_quantities[$index] > 0) {
                if ($fulfillable_quantities[$index] == $line_item->fulfillable_quantity) {
                    $line_item->fulfillment_status = 'fulfilled';

                } else if ($fulfillable_quantities[$index] < $line_item->fulfillable_quantity) {
                    $line_item->fulfillment_status = 'partially-fulfilled';
                }
                $line_item->fulfillable_quantity = $line_item->fulfillable_quantity - $fulfillable_quantities[$index];
            }
            $line_item->save();
        }
        $order->status = 'fulfilled';
        $order->save();


        $fulfillment = new OrderFulfillment();
        if ($order->custom == 0) {
            $fulfillment->fulfillment_shopify_id = $response->body->fulfillments[0]->id;
            $fulfillment->name = $response->body->fulfillments[0]->name;
        } else {
            $count = count($order->fulfillments) + 1;
            $fulfillment->name = $order->name . '.F' . $count;
        }
        $fulfillment->merchant_order_id = $order->id;
        $fulfillment->status = 'fulfilled';
        $fulfillment->save();

        /*Maintaining Log*/
        $order_log = new OrderLog();
        $order_log->message = "A fulfillment named " . $fulfillment->name . " has been processed successfully on " . date_create($fulfillment->created_at)->format('d M, Y h:i a');
        $order_log->status = "Fulfillment";
        $order_log->merchant_order_id = $order->id;
        $order_log->save();

        foreach ($order->line_items as $index => $item) {
            if ($fulfillable_quantities[$index] > 0) {
                $fulfillment_line_item = new FulfillmentLineItem();
                $fulfillment_line_item->fulfilled_quantity = $fulfillable_quantities[$index];
                $fulfillment_line_item->order_fulfillment_id = $fulfillment->id;
                $fulfillment_line_item->order_line_item_id = $item->id;
                $fulfillment_line_item->save();

            }
        }
//        if ($order->admin_shopify_id != null) {
//            $this->admin_maintainer->admin_order_fullfillment($order, $request, $fulfillment);
//        }

        $user = $order->has_user;
//        try{
//            Mail::to($user->email)->send(new OrderStatusMail($user, $order));
//        }
//        catch (\Exception $e){
//        }

//        $this->log->store(0, 'Order', $order->id, $order->name, 'Order Line Items Fulfilled');
//        $this->notify->generate('Order', 'Order Fulfillment', $order->name . ' line items fulfilled', $order);
        return redirect()->route('supplier.order.detail', $id)->with('success', 'Order Line Items Marked as Fulfilled Manually Successfully!');
    }

    public function set_fulfilments(Request $request, $id, $fulfillable_quantities, $order, $response): RedirectResponse
    {
        foreach ($order->line_items as $index => $item) {
            $line_item = MerchantLineItems::find($item->id);
            if ($line_item != null && $fulfillable_quantities[$index] > 0) {
                if ($fulfillable_quantities[$index] == $line_item->fulfillable_quantity) {
                    $line_item->fulfillment_status = 'fulfilled';

                } else if ($fulfillable_quantities[$index] < $line_item->fulfillable_quantity) {
                    $line_item->fulfillment_status = 'partially-fulfilled';
                }
                $line_item->fulfillable_quantity = $line_item->fulfillable_quantity - $fulfillable_quantities[$index];
            }
            $line_item->save();
        }
        $order->status = $order->getStatus($order);
        $order->save();

        $fulfillment = new OrderFulfillment();
        if ($order->custom == 0) {
            $fulfillment->fulfillment_shopify_id = $response->body->fulfillment->id;
            $fulfillment->name = $response->body->fulfillment->name;
        } else {
            $count = count($order->fulfillments) + 1;
            $fulfillment->name = $order->name . '.F' . $count;
        }
        $fulfillment->merchant_order_id = $order->id;
        $fulfillment->status = 'fulfilled';
        $fulfillment->save();

        /*Maintaining Log*/
        $order_log = new OrderLog();
        $order_log->message = "A fulfillment named " . $fulfillment->name . " has been processed successfully on " . date_create($fulfillment->created_at)->format('d M, Y h:i a');
        $order_log->status = "Fulfillment";
        $order_log->merchant_order_id = $order->id;
        $order_log->save();

        foreach ($order->line_items as $index => $item) {
            if ($fulfillable_quantities[$index] > 0) {
                $fulfillment_line_item = new FulfillmentLineItem();
                $fulfillment_line_item->fulfilled_quantity = $fulfillable_quantities[$index];
                $fulfillment_line_item->order_fulfillment_id = $fulfillment->id;
                $fulfillment_line_item->order_line_item_id = $item->id;
                $fulfillment_line_item->save();
            }
        }
//        if ($order->admin_shopify_id != null) {
//            $this->admin_maintainer->admin_order_fullfillment($order, $request, $fulfillment);
//        }

        $user = $order->has_user;
//        try{
//            Mail::to($user->email)->send(new OrderStatusMail($user, $order));
//        }
//        catch (\Exception $e){
//        }

//        $this->log->store(0, 'Order', $order->id, $order->name, 'Order Line Items Fulfilled');
//        $this->notify->generate('Order', 'Order Fulfillment', $order->name . ' line items fulfilled', $order);
        return redirect()->route('supplier.order.detail', $id)->with('success', 'Order Line Items Marked as Fulfilled Successfully!');
    }




}

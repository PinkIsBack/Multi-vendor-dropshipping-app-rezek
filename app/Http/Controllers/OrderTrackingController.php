<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use App\Models\MerchantOrder;
use App\Models\OrderTracking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderTrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $log;
    public function __construct()
    {
        $this->log = new HelperController();
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $track = new OrderTracking();
        $track->order_id= $request->order_id;
        $track->supplier_id= $request->supplier_id;
        $track->courier_name = $request->name;
        $track->courier_code= $request->code;
        $track->number= $request->number;
        $track->url= $request->url;
        $track->cost_shipping= $request->cost;
//        $track->note= $request->url;
        $track->save();
//        return  redirect()->back()->with('success','Tracking add to this order successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderTracking  $orderTracking
     * @return \Illuminate\Http\Response
     */
    public function show(OrderTracking $orderTracking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderTracking  $orderTracking
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderTracking $orderTracking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderTracking  $orderTracking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $track = OrderTracking::find($request->id);
        $track->courier_name = $request->name;
        $track->courier_code= $request->code;
        $track->number= $request->number;
        $track->url= $request->url;
        $track->cost_shipping= $request->cost;
        $track->save();
        $order = MerchantOrder::find($track->order_id);
        $finance = Finance::where([['order_id',$track->order_id],['supplier_id',$track->supplier_id]])->first();
        $this->log->finance_log($order,$finance,4,null,$track);
        return  redirect()->back()->with('success','Tracking detail updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderTracking  $orderTracking
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderTracking $orderTracking)
    {
        //
    }
}

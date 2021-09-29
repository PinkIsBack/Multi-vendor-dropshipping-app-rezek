<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use App\Models\MerchantOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinanceController extends Controller
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

    public function index(Request $request)
    {
        $finances = Finance::where('id','!=',null)->newQuery();
        if ($request->has('search')) {
            $search =$request->get('search');
            $finances = $finances->whereHas('order',function ($query) use ($search){
             return $query->where('admin_shopify_name', 'LIKE', '%' . $search . '%');
            })->orwherehas('supplier',function ($query) use ($search){
                return $query->where('name', 'LIKE', '%' . $search . '%');
            });

        }



        $total_pending = Finance::where('is_paid',0)->sum('cost_products');
        $total_product_cost = $finances->get()->sum('cost_products');
        $total_shipping_cost = $finances->get()->sum(function ($finanace){
            return $finanace->cost_shipping;
        });


        $finances = $finances->paginate(10);
        $search = $request->input('search');
       return view('users.finance.index',compact('finances','search','total_pending','total_product_cost','total_shipping_cost'));
    }


    public function payNow($id){
       $finance = Finance::find($id);
       $finance->is_paid = 1;
       $finance->paid_at = now();
       $finance->save();
       $order = MerchantOrder::find($finance->order_id);
       $this->log->finance_log($order,$finance,5);
       return redirect()->back()->with('success','Request completed successfully!');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Finance  $finance
     * @return \Illuminate\Http\Response
     */
    public function show(Finance $finance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Finance  $finance
     * @return \Illuminate\Http\Response
     */
    public function edit(Finance $finance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Finance  $finance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Finance $finance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Finance  $finance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Finance $finance)
    {
        //
    }
}

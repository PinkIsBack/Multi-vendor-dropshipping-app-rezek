<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use App\Models\MerchantOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierFinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $finances = Finance::where('supplier_id',Auth::user()->id)->newQuery();
        if ($request->has('search')) {
            $search =$request->get('search');
            $finances = $finances->whereHas('order',function ($query) use ($search){
                return $query->where('admin_shopify_name', 'LIKE', '%' . $search . '%');
            });

        }

        $total_product_cost = $finances->get()->sum('cost_products');
        $total_shipping_cost = $finances->get()->sum(function ($finanace){
           return $finanace->cost_shipping;
        });
        $total_pending = Finance::where('supplier_id',Auth::user()->id)->where('is_paid',0)->sum('cost_products');
//        dd($total_pending);

      $data = $finances->get();
      $total_pay = ($data->sum(function ($finance){
            return ($finance->order->supplier_pay);
        }));

//        done
//       $total_weg =  MerchantOrder::where('paid',1)->has('supplier_line_item')->get();
//       dd($total_weg->sum(function ($item){
//           return $item->supplier_pay;
//       }));
//        $finances = $finances->get();
//       $dd = $finances->sum(function ($finance){
//
//          return $finance->order->get()->sum(function($ord) {
//                return $ord->supplier_price;
//            });
//        });
//        dd($dd);

//        $sum = $finances->whereHas('order',function ($query){
//           return  $query->sum(function($item) {
//               return $item->supplier_price;
//           });
//        });
//        dd($sum);


        $finances = $finances->paginate(10);

        $search = $request->input('search');
        return view('supplier.finance.index',compact('finances','search','total_product_cost','total_shipping_cost','total_pending'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

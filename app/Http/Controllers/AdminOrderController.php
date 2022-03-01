<?php

namespace App\Http\Controllers;

use App\Models\MerchantOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOrderController extends Controller
{
    public function index(Request $request){


        $orders = MerchantOrder::where('paid', 1)->newQuery();
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

        $orders = $orders->orderBy('id', 'DESC')->paginate(30);
        return view('users.orders.index')->with([
            'orders' => $orders,
            'search' => $request->input('search')
        ]);
    }

    public function detail($id)
    {

        $order = MerchantOrder::find($id);
        if ($order != null) {
            return view('users.orders.detail')->with([
                'order' => $order
            ]);
        }
    }

    public function payfast_paid_success(Request $request,$id)
    {
        $order = MerchantOrder::where('id',$id)->firstOrfail();
        $order->is_supplier = 1;
        $order->save();
        return redirect()->route('admin.order.detail',$order->id)->with('success','Order paid successfully');

    }
}

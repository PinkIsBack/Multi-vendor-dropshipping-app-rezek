<?php

namespace App\Http\Controllers;

use App\Models\MerchantOrder;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {

            $data = [];
            if (auth()->user()->hasRole('Admin')) {

                $order = MerchantOrder::where('paid', 1)->orderBy('id', 'desc')->get();
                $data = [
                    'user_merchant' => User::role('Merchant')->count(),
                    'user_supplier' => User::role('Supplier')->count(),
                    'order_count' => $order->count(),
                    'revenue' => $order->sum('commission'),
                    'orders' => $order->take(5),
                ];

            }
            if (auth()->user()->hasRole('Supplier')) {
                $order = MerchantOrder::where('paid', 1)->has('supplier_line_item')->orderBy('id', 'desc')->get();


                $product = Product::where('supplier_id', Auth::user()->id)->get();
                $order_unfulfill = MerchantOrder::where('paid', 1)->whereHas('supplier_line_item', function ($q) {
                    return $q->where('is_supplier_fulfill', 0);
                });
                $data = [
                    'product_count' => $product->count(),
                    'product_active' => $product->where('admin_status', 3)->count(),
                    'order_count' => $order->count(),
                    'order_unfulfill' => $order_unfulfill->count(),
                    'orders' => $order->take(5),
                ];
            }
            if (auth()->user()->hasRole('Merchant')) {
                $order = MerchantOrder::where('shop_id', auth()->user()->id)->orderBy('id', 'desc')->get();
                $data = [
                    'order_count' => $order->count(),
                    'order_unpaid' => $order->where('paid', 0)->count(),
                    'order_unfulfill' => $order->whereIn('status', ['unfulfilled', 'Paid'])->count(),
                    'revenue' => $order->sum('total_price') - $order->sum('cost_to_pay'),
                    'orders' => $order->take(5),
                ];
            }

            return view('dashboard', $data);
        }
        catch (\Exception $x){
            dd($x);
        }
    }
}

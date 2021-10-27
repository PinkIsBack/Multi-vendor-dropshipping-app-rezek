@extends('layouts.index')
@section('content')
    <div class="row mb-3">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <span class="font-weight-bold font-20 vertical-align-middle">Orders</span>
        </div>

    </div>
    @include('layouts.flash_message')
    <form action="">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="input-group mb-3">
                    <input type="search" value="{{$search}}" name="search" placeholder="Search by Order ID"
                           class="form-control h-100">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" >Search</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-md-12">
            <div class="card radius-15">
                {{--                    <div class="card-header bulk-div" style="display: none">--}}
                {{--                        <div class="btn-group">--}}
                {{--                            <button class="btn btn-outline-secondary btn-sm bulk-wallet-btn">Pay in Bulk</button>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                <div class="card-body table-responsive">
                    @if (count($orders) > 0)
                        <table class="table table-hover table-borderless">
                            <thead class="border-bottom">
                            <tr>


                                <th>Name</th>
                                <th>Order#</th>
                                <th>Order Date</th>
                                <th>Cost</th>
                                <th>Payment Status</th>
                                <th>Status</th>
                                <th>Stock Status</th>
                            </tr>
                            </thead>

                            @foreach($orders as $index => $order)
                                <tbody class="">
                                <tr>


                                    <td class="font-w600">
                                        <a href="{{route('supplier.order.detail',$order->id)}}">{{ $order->name }}</a>
                                    </td>
                                        <td>
                                            {{$order->admin_shopify_name}}
                                        </td>
                                    <td>
                                        {{date_create($order->shopify_created_at)->format('d m, Y h:i a') }}

                                    </td>


                                    <td>
                                        {{number_format($order->supplier_pay,2)}} {{ \App\Helpers\AppHelper::currency() }}

                                    </td>
                                    <td>
                                        @if($order->paid == '0')
                                            <span class="badge badge-warning text-white"> Unpaid </span>
                                        @elseif($order->paid == '1')
                                            <span class="badge badge-success"> Paid </span>
                                        @elseif($order->paid == '2')
                                            <span class="badge badge-danger"> Refunded</span>
                                        @endif

                                    </td>
                                        <td>
                                            @if($order->supplier_line_item->where('is_supplier_fulfill',0)->count() > 0)
                                                <span class="badge badge-warning text-white"> Unfulfilled</span>
                                            @else
                                                <span class="badge badge-success text-white"> fulfilled</span>
                                            @endif
                                        </td>

                                    <td>
                                        @php
                                            $out_of_stock = 0;
                                            foreach($order->line_items()->where('fulfilled_by', 'fantasy')->get() as $item) {
                                                if($item->linked_variant == null && $item->linked_product == null)
                                                    $out_of_stock += 1;

                                                if($item->linked_variant && $item->linked_variant->quantity == 0) {
                                                    $out_of_stock += 1;
                                                }
                                                else if($item->linked_variant == null && $item->linked_product && $item->linked_product->quantity == 0){
                                                    $out_of_stock += 1;
                                                }
                                            }
                                        @endphp

                                        @if($order->line_items->where('fulfilled_by', 'store')->count() > 0)
                                            @if($order->line_items()->where('fulfilled_by', 'fantasy')->count() == $out_of_stock)
                                                <span class="badge badge-danger"> Out of Stock </span>
                                            @else
                                                <span
                                                    class="badge badge-warning text-white"> Partial Out of Stock </span>
                                            @endif
                                        @else
                                            @if($out_of_stock == 0)
                                                <span class="badge badge-primary"> In Stock </span>
                                            @elseif($order->line_items()->count() == $out_of_stock)
                                                <span class="badge badge-danger"> Out of Stock </span>
                                            @else
                                                <span
                                                    class="badge badge-warning text-white"> Partial out of Stock </span>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <div class="btn-group">
                                            <a href="{{route('supplier.order.detail',$order->id)}}"
                                               class="btn btn-sm btn-primary" type="button">View</a>

                                        </div>

                                    </td>

                                </tr>
                                </tbody>

                            @endforeach
                        </table>

                        <div class="row">
                            <div class="col-md-12 text-center" style="font-size: 17px">
                                {!! $orders->appends(request()->input())->links() !!}
                            </div>
                        </div>
                    @else
                        <p>No Orders Found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{--    <form action="{{route('store.orders.bulk.payment')}}" id="bulk-payment" method="post">--}}
    {{--        @csrf--}}
    {{--        <input type="hidden" name="orders" class="">--}}
    {{--    </form>--}}


@endsection

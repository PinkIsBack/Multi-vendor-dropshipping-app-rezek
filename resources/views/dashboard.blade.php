@extends('layouts.index')

@section('content')
    @role('Merchant')
    <div class="row">
        <div class="col-12 col-lg-3">
            <div class="card radius-15 bg-voilet">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2 class="mb-0 text-white">{{$order_count}} <i class="bx bxs-down-arrow-alt font-14 text-white"></i> </h2>
                        </div>
                        <div class="ml-auto font-35 text-white"><i class="bx bx-box"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-white">Total Orders</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card radius-15 bg-primary-blue">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2 class="mb-0 text-white">{{$order_unpaid}} </h2>
                        </div>
                        <div class="ml-auto font-35 text-white"><i class="bx bx-notepad"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-white">Unpaid Orders</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card radius-15 bg-rose">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2 class="mb-0 text-white">{{$order_unfulfill}} </h2>
                        </div>
                        <div class="ml-auto font-35 text-white"><i class="bx bxs-truck"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-white">Unfulfill Orders</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card radius-15 bg-sunset">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2 class="mb-0 text-white">{{$revenue}} </h2>
                        </div>
                        <div class="ml-auto font-35 text-white"><i class="bx bx-money"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-white">Revenue</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--  recent order list --}}
    <div class="card radius-15">
        <div class="card-header border-bottom-0">
            <div class="d-flex align-items-center">
                <div>
                    <h5 class="mb-0">Recent Orders</h5>
                </div>
                <div class="ml-auto">
                    <a href="{{route('store.orders')}}" class="btn btn-white radius-15">View More</a>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>Price</th>
                        <th>Cost</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td class="font-w600">
                            <a href="{{route('store.order.detail',$order->id)}}">{{ $order->name }}</a>
                        </td>
                        <td>
                            {{number_format($order->total_price,2)}}  {{ \App\Helpers\AppHelper::currency() }}
                        </td>
                        <td>
                            {{number_format($order->cost_to_pay,2)}}  {{ \App\Helpers\AppHelper::currency() }}

                        </td>
                        <td>
                            {{date_create($order->shopify_created_at)->format('d m, Y h:i a') }}

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
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endrole

    @role('Supplier')
    <div class="row">

        <div class="col-12 col-lg-3">
            <div class="card radius-15 bg-primary-blue">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2 class="mb-0 text-white">{{$product_count}} </h2>
                        </div>
                        <div class="ml-auto font-35 text-white"><i class="bx bx-notepad"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-white">Total Products</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card radius-15 bg-sunset">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2 class="mb-0 text-white">{{$product_active}} </h2>
                        </div>
                        <div class="ml-auto font-35 text-white"><i class="bx bx-money"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-white">Active Products</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card radius-15 bg-voilet">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2 class="mb-0 text-white">{{$order_count}} <i class="bx bxs-down-arrow-alt font-14 text-white"></i> </h2>
                        </div>
                        <div class="ml-auto font-35 text-white"><i class="bx bx-box"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-white">Total Orders</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card radius-15 bg-rose">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2 class="mb-0 text-white">{{$order_unfulfill}} </h2>
                        </div>
                        <div class="ml-auto font-35 text-white"><i class="bx bxs-truck"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-white">Unfulfill Orders</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    {{--  recent order list --}}
    <div class="card radius-15">
        <div class="card-header border-bottom-0">
            <div class="d-flex align-items-center">
                <div>
                    <h5 class="mb-0">Recent Orders</h5>
                </div>
                <div class="ml-auto">
                    <a href="{{route('supplier.orders.all')}}" class="btn btn-white radius-15">View More</a>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="border-bottom">

                    <tr>


                        <th>Name</th>
                        <th>Order#</th>
                        <th>Order Date</th>
                        <th>Cost</th>
                        <th>Status</th>
                    </tr>

                    </thead>

                        <tbody class="">
                        @foreach($orders as $index => $order)
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
                                {{number_format($order->supplier_pay,2)}} USD

                            </td>

                            <td>
                                @if($order->supplier_line_item->where('is_supplier_fulfill',0)->count() > 0)
                                    <span class="badge badge-warning text-white"> Unfulfilled</span>
                                @else
                                    <span class="badge badge-success text-white"> fulfilled</span>
                                @endif
                            </td>



                        </tr>

                        @endforeach
                        </tbody>

                </table>
            </div>
        </div>
    </div>
    @endrole
    @role('Admin')
    <div class="row">
        <div class="col-12 col-lg-3">
            <div class="card radius-15 bg-voilet">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2 class="mb-0 text-white">{{$user_merchant}}  </h2>
                        </div>
                        <div class="ml-auto font-35 text-white"><i class="bx bx-user-plus"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-white">Total Merchant</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card radius-15 bg-primary-blue">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2 class="mb-0 text-white">{{$user_supplier}} </h2>
                        </div>
                        <div class="ml-auto font-35 text-white"><i class="bx bx-user-pin"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-white">Total Supplier</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card radius-15 bg-rose">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2 class="mb-0 text-white">{{$order_count}} </h2>
                        </div>
                        <div class="ml-auto font-35 text-white"><i class="bx bx-book-content"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-white">Total Orders</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card radius-15 bg-sunset">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2 class="mb-0 text-white">{{$revenue}} </h2>
                        </div>
                        <div class="ml-auto font-35 text-white"><i class="bx bx-money"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-white">Revenue</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--  recent order list --}}
    <div class="card radius-15">
        <div class="card-header border-bottom-0">
            <div class="d-flex align-items-center">
                <div>
                    <h5 class="mb-0">Recent Orders</h5>
                </div>
                <div class="ml-auto">
                    <a href="{{route('orders.all')}}" class="btn btn-white radius-15">View More</a>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>Price</th>
                        <th>Cost</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td class="font-w600">
                                <a href="{{route('store.order.detail',$order->id)}}">{{ $order->name }}</a>
                            </td>
                            <td>
                                {{number_format($order->total_price,2)}}  {{ \App\Helpers\AppHelper::currency() }}
                            </td>
                            <td>
                                {{number_format($order->cost_to_pay,2)}}  {{ \App\Helpers\AppHelper::currency() }}

                            </td>
                            <td>
                                {{date_create($order->shopify_created_at)->format('d m, Y h:i a') }}

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
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endrole
@endsection

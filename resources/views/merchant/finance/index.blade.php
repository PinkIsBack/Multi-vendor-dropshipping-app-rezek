@extends('layouts.index')
@section('content')
    <div class="row mb-3">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <span class="font-weight-bold font-20 vertical-align-middle">Finance</span>
        </div>

    </div>

    <div class="row mb-3">
        <div class="card-deck flex-column flex-lg-row col-12">
            <div class="card radius-15 bg-info">
                <div class="card-body text-center">
                    <div class="widgets-icons mx-auto rounded-circle bg-white"><i class="bx bxs-dollar-circle"></i>
                    </div>
                    <h4 class="mb-0 font-weight-bold mt-3 text-white">{{ \App\Helpers\AppHelper::currency() }} {{$total_earning}}</h4>
                    <p class="mb-0 text-white">Total Earning</p>
                </div>
            </div>
            <div class="card radius-15 bg-wall">
                <div class="card-body text-center">
                    <div class="widgets-icons mx-auto bg-white rounded-circle"><i class="bx bx-bookmark-alt"></i>
                    </div>
                    <h4 class="mb-0 font-weight-bold mt-3 text-white">{{$this_week_orders}}</h4>
                    <p class="mb-0 text-white">Total Orders This Week</p>
                </div>
            </div>
            <div class="card radius-15 bg-rose">
                <div class="card-body text-center">
                    <div class="widgets-icons mx-auto bg-white rounded-circle"><i class="bx bx-bulb"></i>
                    </div>
                    <h4 class="mb-0 font-weight-bold mt-3 text-white">{{ \App\Helpers\AppHelper::currency() }} {{$total}}</h4>
                    <p class="mb-0 text-white">Total Order Payments</p>
                </div>
            </div>
        </div>
    </div>


    @include('layouts.flash_message')
    <form action="">
        <div class="row ">
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


                                <th>Order#</th>
                                <th>Selling Price</th>
                                <th>Cost</th>
                                <th>Shipping Cost</th>
                                <th>Total Cost</th>
                                <th>Earning</th>
                                <th>Status</th>
                            </tr>
                            </thead>

                            @foreach($orders as $index => $order)
                                <tbody class="">
                                <tr>


                                    <td>
                                        <a href="{{route('store.order.detail',$order->id)}}">{{$order->admin_shopify_name}}</a>
                                    </td>

                                    <td>
                                        {{number_format($order->total_price,2)}} USD
                                    </td>
                                    <td>
                                        {{number_format($order->cost_to_pay,2)}} USD

                                    </td>
                                    <td>
                                        {{number_format($order->shipping_price,2)}} USD

                                    </td>
                                    <td>
                                        {{number_format($order->cost_to_pay + $order->shipping_price,2)}} USD

                                    </td>
                                    <td>
                                        {{number_format($order->total_price - $order->cost_to_pay,2)}} USD
                                    </td>
                                    <td>
                                        @if($order->status == 'Paid')
                                            <span class="badge badge-warning text-white"> Unfulfilled</span>
                                        @elseif($order->status == 'unfulfilled')
                                            <span
                                                class="badge badge-warning text-white"> {{ucfirst($order->status)}}</span>
                                        @elseif($order->status == 'partially-shipped')
                                            <span class="badge "
                                                  style="font-size: small;background: darkolivegreen;color: white;"> {{ucfirst($order->status)}}</span>
                                        @elseif($order->status == 'shipped')
                                            <span class="badge "
                                                  style="font-size: small;background: orange;color: white;"> {{ucfirst($order->status)}}</span>
                                        @elseif($order->status == 'delivered')
                                            <span class="badge "
                                                  style="font-size: small;background: deeppink;color: white;"> {{ucfirst($order->status)}}</span>
                                        @elseif($order->status == 'completed')
                                            <span class="badge "
                                                  style="font-size: small;background: darkslategray;color: white;"> {{ucfirst($order->status)}}</span>
                                        @elseif($order->status == 'new')
                                            <span class="badge badge-warning"> Draft </span>
                                        @elseif($order->status == 'cancelled')
                                            <span class="badge badge-warning"> {{ucfirst($order->status)}} </span>
                                        @else
                                            <span class="badge badge-success">  {{ucfirst($order->status)}} </span>
                                        @endif

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
                        <p>No Orders Found </p>
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

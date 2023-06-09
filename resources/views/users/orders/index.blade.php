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

                                <th>#</th>
                                <th>Name</th>
                                <th>Order#</th>
                                <th>Merchant </th>
                                <th>Order Date</th>
                                <th>Price</th>
                                <th>Cost</th>
                                <th>Payment Status</th>
                                <th>Status</th>
                                <th>Stock Status</th>
                            </tr>
                            </thead>

                            @foreach($orders as $index => $order)
                                <tbody class="">
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td class="font-w600">
                                        <a href="{{route('admin.order.detail',$order->id)}}">{{ $order->name }}</a>
                                    </td>
                                        <td>
                                            {{$order->admin_shopify_name}}
                                        </td>
                                    <td>
                                        {{optional($order->has_store)->name}}
                                    </td>
                                    <td>
                                        {{date_create($order->shopify_created_at)->format('d m, Y h:i a') }}

                                    </td>

                                    <td>
                                        {{number_format($order->total_price,2)}} {{ \App\Helpers\AppHelper::currency() }}
                                    </td>
                                    <td>
                                        {{number_format($order->cost_to_pay,2)}} {{ \App\Helpers\AppHelper::currency() }}

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
                                            <a href="#"
                                               data-toggle="modal"
                                               data-target="#ordered_modal_{{$index}}"
                                               class="btn btn-sm {{$order->is_ordered?'btn-success':'btn-warning'}}" type="button">Ordered</a>
                                            <a href="{{route('admin.order.detail',$order->id)}}"
                                               class="btn btn-sm btn-primary" type="button">View</a>
                                            <a
                                                {{--                                                    href="{{route('store.order.delete',$order->id)}}"--}}
                                                class="btn btn-sm btn-danger" type="button">Delete</a>
                                        </div>

                                    </td>

                                </tr>
                                </tbody>
                                {{--    MODAL--}}
                                <div class="modal fade" id="ordered_modal_{{$index}}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Ordered</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <form method="post" action="{{route('ordered.store')}}">
                                                <input type="hidden" name="id" value="{{$order->id}}">
                                                @csrf
                                                <input type="hidden" name="is_ordered" value="1">
                                                <div class="modal-body">

                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                                            <div class="form-group">
                                                                <label>Order Number</label>
                                                                <input type="text" name="ordered_number" value="{{$order->ordered_number}}" id="" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                                            <div class="form-group">
                                                                <label>Ordered Date</label>
                                                                <input type="date" name="ordered_date" value="{{$order->ordered_date}}" id="" class="form-control">
                                                              </div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                                            <div class="form-group">
                                                                <label>Comments</label>
                                                                <textarea class="form-control" name="comment" id="" cols="10" rows="10">{{$order->comment}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>

                                            </form>>
                                        </div>
                                    </div>
                                </div>

                                {{--    END MODAL--}}
                            @endforeach
                        </table>

                        <div class="row">
                            <div class="col-md-12 text-center" style="font-size: 17px">
                                {{ $orders->links("pagination::bootstrap-4") }}
{{--                                {!! $orders->appends(request()->input())->links() !!}--}}
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

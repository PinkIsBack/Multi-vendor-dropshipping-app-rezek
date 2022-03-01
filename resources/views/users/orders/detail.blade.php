@extends('layouts.index')
@section('content')
    <div class="row mb-3">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <span class="font-weight-bold font-20 vertical-align-middle">Order Detail</span>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            @if($order->paid == 1)
                @if($order->refund_request == 1 && $order->is_refunded == 0)

                    <a href="{{route('store.order.refund.request')}}/?id={{$order->id}}&admin=1&accept=1" onclick="if(confirm('Are you sure?'){return true;}else{return false;})" class="btn btn-sm btn-danger">Refund</a>
                    <a href="{{route('store.order.refund.request')}}/?id={{$order->id}}&admin=1&cancel=1" class="btn btn-sm btn-success">Cancel</a>
                @endif
                    @if($order->is_refunded == 1)
                        <button class="btn btn-sm btn-success" disabled>Refund Approved</button>
                    @elseif($order->is_refunded == 2)
                        <button class="btn btn-sm btn-danger" disabled>Refund Rejected</button>
                    @endif
            @endif
        </div>
    </div>
    @include('layouts.flash_message')

    <div class="row">
        <div class="col-md-9">
            <div class="card radius-15">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h6>Line Items</h6>
                        </div>

                        <div class="col-6 text-right">
                    @if($order->paid == '0')
                                <span class="badge badge-warning text-white"> Unpaid </span>
                            @elseif($order->paid == '1')
                                <span class="badge badge-success"> Paid </span>
                            @elseif($order->paid == '2')
                                <span class="badge badge-danger"> Refunded</span>
                            @endif

                            @if($order->status == 'Paid')
                                <span class="badge badge-warning text-white"> Unfulfilled</span>
                            @elseif($order->status == 'unfulfilled')
                                <span class="badge badge-warning text-white"> {{ucfirst($order->status)}}</span>
                            @elseif($order->status == 'partially-shipped')
                                <span class="badge " style="background: darkolivegreen;color: white;"> {{ucfirst($order->status)}}</span>
                            @elseif($order->status == 'shipped')
                                <span class="badge " style="background: orange;color: white;"> {{ucfirst($order->status)}}</span>
                            @elseif($order->status == 'delivered')
                                <span class="badge " style="background: deeppink;color: white;"> {{ucfirst($order->status)}}</span>
                            @elseif($order->status == 'completed')
                                <span class="badge " style="background: darkslategray;color: white;"> {{ucfirst($order->status)}}</span>
                            @elseif($order->status == 'new')
                                <span class="badge badge-warning text-white"> Draft </span>
                            @elseif($order->status == 'cancelled')
                                <span class="badge badge-warning text-white"> {{ucfirst($order->status)}} </span>
                            @else
                                <span class="badge badge-success">  {{ucfirst($order->status)}} </span>
                            @endif
                    </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <table class="table table-hover table-borderless">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Fulfilled By</th>
                                    <th>Supplier</th>
                                    <th>Supplier price</th>
                                    <th>Cost</th>
                                    <th>Supplier Status</th>
                                    <th>Stock Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $total_discount = 0;
                                    $is_monthly_discount = false;
                                    $n = $order->line_items->where('fulfilled_by', '!=', 'store')->sum('quantity');
                                    $line_item_count = count($order->line_items);
                                @endphp

                                @foreach($order->line_items as $item)
                                    @if($item->fulfilled_by != 'store')
                                        <tr>
                                            <td>
                                                @if($order->custom == 0)
                                                    @if($item->linked_variant != null)
                                                        <img class="img-avatar" @if($item->linked_variant->has_image == null)  src="https://wfpl.org/wp-content/plugins/lightbox/images/No-image-found.jpg"
                                                             @else @if($item->linked_variant->has_image->isV == 1) src="{{asset($item->linked_variant->has_image->src)}}" @else src="{{asset($item->linked_variant->has_image->src)}}" @endif @endif alt="">
                                                    @else
                                                        @if($item->linked_product != null)
                                                            @if(count($item->linked_product->has_images)>0)
                                                                    <img class="img-avatar img-avatar-variant"
                                                                         src="{{asset($item->linked_product->has_images[0]->src)}}">
                                                            @else
                                                                <img class="img-avatar img-avatar-variant"
                                                                     src="https://wfpl.org/wp-content/plugins/lightbox/images/No-image-found.jpg">
                                                            @endif
                                                        @else
                                                            <img class="img-avatar img-avatar-variant"
                                                                 src="https://wfpl.org/wp-content/plugins/lightbox/images/No-image-found.jpg">
                                                        @endif
                                                    @endif
                                                @else
                                                    @if($item->linked_real_variant != null)
                                                        <img class="img-avatar"
                                                             @if($item->linked_real_variant->has_image == null)  src="https://wfpl.org/wp-content/plugins/lightbox/images/No-image-found.jpg"
                                                             @else @if($item->linked_real_variant->has_image->isV == 1) src="{{asset($item->linked_real_product->has_images[0]->src)}}" @else src="{{asset($item->linked_real_product->has_images[0]->src)}}" @endif @endif alt="">
                                                    @else
                                                        @if($item->linked_real_product != null)
                                                            @if(count($item->linked_real_product->has_images)>0)
                                                                @if($item->linked_real_product->has_images[0]->isV == 1)
                                                                    <img class="img-avatar img-avatar-variant"
                                                                         src="{{asset($item->linked_real_product->has_images[0]->src)}}">
                                                                @else
                                                                    <img class="img-avatar img-avatar-variant"
                                                                         src="{{asset($item->linked_real_product->has_images[0]->src)}}">
                                                                @endif
                                                            @else
                                                                <img class="img-avatar img-avatar-variant"
                                                                     src="https://wfpl.org/wp-content/plugins/lightbox/images/No-image-found.jpg">
                                                            @endif
                                                        @else
                                                            <img class="img-avatar img-avatar-variant"
                                                                 src="https://wfpl.org/wp-content/plugins/lightbox/images/No-image-found.jpg">
                                                        @endif
                                                    @endif
                                                @endif
                                            </td>
                                            <td>{{$item->name}}</td>
                                            <td>@if($item->fulfilled_by == 'store')
                                                    <span class="badge badge-danger"> Store</span>
                                                @elseif ($item->fulfilled_by == 'ZADropship')
                                                    <span class="badge badge-primary"> ZADropship </span>
                                                @else
                                                    <span class="badge badge-primary"> {{$item->fulfilled_by}} </span>
                                                @endif
                                            </td>
                                            <td>
                                                {{optional($item->supplier)->name}}
                                            </td>
                                            <td>{{ \App\Helpers\AppHelper::currency() }}{{number_format($item->supplier_price,2)}}  * {{$item->quantity}}</td>
                                            <td>{{ \App\Helpers\AppHelper::currency() }}{{number_format($item->cost,2)}}  * {{$item->quantity}}</td>
                                          <td>
                                              @if($item->is_supplier_fulfill == 0)
                                                  <span class="badge badge-warning text-white"> Unfulfilled</span>
                                                @else
                                                  <span class="badge badge-success"> Fulfilled</span>
                                              @endif

                                          </td>


                                            <td>
                                                @php
                                                    $out_of_stock = false;
                                                    if($item->linked_variant) {
                                                        if($item->linked_variant->quantity == 0)
                                                            $out_of_stock = true;
                                                    }
                                                    elseif($item->linked_product){
                                                        if($item->linked_product->quantity == 0)
                                                            $out_of_stock = true;
                                                    }

                                                @endphp
                                                @if($out_of_stock || ($item->linked_variant == null && $item->linked_product == null))
                                                    <span class="badge badge-danger"> Out of Stock </span>
                                                @else
                                                    <span class="badge badge-primary"> In Stock </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach

                                </tbody>


                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card radius-15">
                <div class="card-header">
                    <h6 class="card-title">Summary</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless table-hover">
                            <tbody class="js-warehouse-shipping">
                            <tr>
                                <td>
                                    Subtotal ({{count($order->line_items)}} items)
                                </td>
                                <td align="right">
                                    {{ \App\Helpers\AppHelper::currency() }} {{number_format($order->cost_to_pay,2)}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Shipping Price
                                </td>
                                <td align="right">
                                    {{ \App\Helpers\AppHelper::currency() }} {{number_format($order->shipping_price,2)}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Total Cost
                                </td>
                                <td align="right">
                                    {{number_format($order->cost_to_pay + $order->shipping_price  ,2)}} ZAR
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Commission
                                </td>
                                <td align="right">
                                  -  {{ \App\Helpers\AppHelper::currency() }} {{number_format($order->commission,2)}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Pay to Supplier
                                </td>
                                <td align="right" class="shipping_price_text">
                                   {{ \App\Helpers\AppHelper::currency() }} {{ number_format($order->cost_to_pay + $order->shipping_price - $order->commission ,2) }}
                                </td>
                            </tr>


                            </tbody>
                        </table>
                </div>
            </div>




            {{--            Logs--}}

            @include('inc.order_logs')
            {{--            End Logs--}}

        </div>
        <div class="col-md-3">
            <div class="card radius-15">
                <div class="card-body">
                    <h6>Notes</h6>
                @if($order->notes != null)
                        {{$order->notes}}
                    @else
                        <p> No Notes</p>
                    @endif
                </div>
            </div>
            @if($order->customer != null)
                <div class="card radius-15">
                    @php
                        $customer = json_decode($order->customer);
                        $billing = json_decode($order->billing_address);
                        $shipping = json_decode($order->shipping_address)
                    @endphp
                    <div class="card-body">
                        <h6>Customer</h6>
                        <p style="font-size: 14px">{{$customer->first_name}} {{$customer->last_name}} <br>{{$customer->orders_count}} Orders</p>
                        <hr>
                        <h6>Customer Information</h6>
                        <p style="font-size: 14px">{{$customer->email}}<br>{{$customer->phone}}</p>
                        @if($billing != null)
                            <hr>
                            <h6>Billing Address</h6>
                            <p style="font-size: 14px">{{$billing->first_name}} {{$billing->last_name}} <br> {{$billing->company}}
                                <br> {{$billing->address1}}
                                <br> {{$billing->address2}}
                                <br> {{$billing->city}}
                                <br> {{$billing->province}} {{$billing->zip}}
                                <br> {{$billing->country}}
                                <br> {{$billing->phone}}
                            </p>
                        @endif
                        @if($shipping != null)
                            <hr>
                            <h6>Shipping Address</h6>
                            <p style="font-size: 14px">{{$shipping->first_name}} {{$shipping->last_name}}
                                <br> {{$shipping->company}}
                                <br> {{$shipping->address1}}
                                <br> {{$shipping->address2}}
                                <br> {{$shipping->city}}
                                <br> {{$shipping->province}} {{$shipping->zip}}
                                <br> {{$shipping->country}}
                                @if(isset($shipping->phone))
                                    <br>{{$shipping->phone}}
                                @endif
                            </p>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

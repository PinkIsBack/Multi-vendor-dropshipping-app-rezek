@extends('layouts.index')
@section('content')
    <div class="row mb-3">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <span class="font-weight-bold font-20 vertical-align-middle">Order Detail ({{$order->admin_shopify_name}})</span>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            @if($order->paid == 1)
            @if($order->refund_request == 1)
              <button class="btn btn-sm btn-danger" disabled>Refund Requested</button>
              @if($order->is_refunded == 1)
                        <button class="btn btn-sm btn-success" disabled>Refund Approved</button>
               @elseif($order->is_refunded == 2)
                        <button class="btn btn-sm btn-danger" disabled>Refund Rejected</button>
              @endif
                @else
                <a href="{{route('store.order.refund.request')}}/?id={{$order->id}}" onclick="if(confirm('Are you sure?'){return true;}else{return false;})" class="btn btn-sm btn-danger">Refund request</a>
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
                                    <th>Cost</th>
                                    <th>Sold Price</th>
                                    <th>Status</th>
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

                                            <td>{{ \App\Helpers\AppHelper::currency() }}{{number_format($item->cost,2)}}  * {{$item->quantity}}</td>
                                            <td>{{ \App\Helpers\AppHelper::currency() }}{{$item->price}} * {{$item->quantity}} </td>
                                            <td>
                                                @if($item->fulfillment_status == null)
                                                    <span class="badge badge-warning text-white"> Unfulfilled</span>
                                                @elseif($item->fulfillment_status == 'partially-fulfilled')
                                                    <span class="badge badge-danger"> Partially Fulfilled</span>
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
                                <td align="right" class="shipping_price_text">
                                   {{ \App\Helpers\AppHelper::currency() }} {{ number_format($order->shipping_price,2) }}
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Total Cost @if($order->paid == 0) to Pay @endif
                                </td>
                                <td align="right" class="total">
                                    {{number_format($order->cost_to_pay + $order->shipping_price  ,2)}}  {{ \App\Helpers\AppHelper::currency() }}
                                </td>
                            </tr>
                            <tr>
                                <td ></td>
                                <td align="right" >
                                    @if($order->paid == 0)
                                    <form action="https://www.payfast.co.za/eng/process" method="post">
                                        <input type="hidden" name="merchant_id" value="18424387">
                                        <input type="hidden" name="merchant_key" value="99ejkvmqtsoq9">
                                        <input type="hidden" name="amount" value="{{$order->cost_to_pay + $order->shipping_price}}">
                                        <input type="hidden" name="item_name" value="{{$order->name}}">
                                        <input type="hidden" name="return_url" value="{{route('store.payfast.pay.success',$order->id)}}">
                                        <input type="hidden" name="cancel_url" value="{{route('store.order.detail',$order->id)}}">
{{--                                        <a href="{{route('store.payfast.pay.success',$order->id)}}" class="btn btn-primary">Pay Now</a>--}}
{{--                                        <button class="btn btn-primary">Pay Now</button>--}}
                                    </form>
                                        <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">

                                                    <input type="hidden" name="email" value="zaecomproviders@gmail.com"> {{-- required --}}
                                                    <input type="hidden" name="orderID" value="{{$order->id}}">
                                                    <input type="hidden" name="amount" value="{{($order->cost_to_pay + $order->shipping_price)*100}}"> {{-- required in kobo --}}
{{--                                                    <input type="hidden" name="quantity" value="3">--}}
                                                    <input type="hidden" name="currency" value="ZAR">
                                                    <input type="hidden" name="metadata" value="{{ json_encode($array = ['orderName' => $order->name,"order_id"=>$order->id]) }}" > {{-- For other necessary things you want to add to your payload. it is optional though --}}
{{--                                                   @dd(Paystack::genTranxRef())--}}
                                                    <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}">

                                                  @csrf

                                                        <button class="btn btn-primary" type="submit" value="Pay Now!">
                                                            <i class="fa fa-plus-circle fa-lg"></i> Pay Now!
                                                        </button>

                                        </form>

                                    @else
                                        <button class="btn btn-primary" disabled>Paid</button>
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>
                </div>
            </div>

            @foreach($order->tracking()->get() as $tracking)
            <div class="card radius-15">
                <div class="card-header">
                    <h6 class="card-title">Tracking</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless table-hover">
                        <tbody class="js-warehouse-shipping">
                        <tr>
                            <td>
                                Courier Name
                            </td>
                            <td align="right">
                                {{$tracking->courier_name }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Tracking Number
                            </td>
                            <td align="right">
                                {{$tracking->number}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Tracking URL
                            </td>
                            <td align="right">
                                {{$tracking->url}}
                            </td>
                        </tr>



                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach

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

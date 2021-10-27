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
                                    <th>Status</th>
                                    <th>Stock Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $total_discount = 0;
                                    $is_monthly_discount = false;
                                    $n = $order->supplier_line_item->where('fulfilled_by', '!=', 'store')->sum('quantity');
                                    $line_item_count = count($order->supplier_line_item);
                                @endphp

                                @foreach($order->supplier_line_item as $item)
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

                                            <td>{{ \App\Helpers\AppHelper::currency() }}{{number_format($item->supplier_price,2)}}  * {{$item->quantity}}</td>
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
                                Subtotal ({{count($order->supplier_line_item)}} items)
                            </td>
                            <td align="right">
                                {{ \App\Helpers\AppHelper::currency() }} {{number_format($order->supplier_pay,2)}}
                            </td>
                        </tr>


                        <tr>
                            <td>
                                Total Cost @if($order->paid == 0) to Pay @endif
                            </td>
                            <td align="right" class="total">
                                {{number_format($order->supplier_pay   ,2)}} {{ \App\Helpers\AppHelper::currency() }}
                            </td>
                        </tr>
                        <tr>
                            <td ></td>
                            <td align="right" >
                                @if($order->supplier_line_item->where('is_supplier_fulfill',0)->count() > 0)
                                    <button  data-toggle="modal" data-target="#trackingmodal" class="btn btn-success" >Mark as Fulfilled</button>
                                @elseif($order->supplier_tracking->count() == 1 )
{{--                                        <button class="btn btn-primary" disabled>Tracking Added</button>--}}
                                @else
{{--                                    <button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#trackingmodal">Add Tracking</button>--}}

                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @if($order->supplier_tracking->count() == 1 )
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
                                {{$order->supplier_tracking->first()->courier_name }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Tracking Number
                            </td>
                            <td align="right">
                                {{$order->supplier_tracking->first()->number}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Shipping Cost
                            </td>
                            <td align="right">
                                {{$order->supplier_tracking->first()->cost_shipping}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Tracking URL
                            </td>
                            <td align="right">
                                {{$order->supplier_tracking->first()->url}}
                            </td>
                        </tr>
                        <tr>
                            <td>

                            </td>
                            <td align="right">
                                <button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#trackingmodaledit">Edit Tracking</button>
                            </td>
                        </tr>


                        </tbody>
                    </table>
                </div>
            </div>
                <!-- Modal -->
                <div class="modal fade" id="trackingmodaledit" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Tracking Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">	<span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{route('supplier.order.tracking.update')}}" method="post">
                                @csrf
                                <input type="hidden" value="{{$order->supplier_tracking->first()->id}}" name="id">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Name:</label>
                                        <input type="text" class="form-control" required name="name" value="{{$order->supplier_tracking->first()->courier_name}}" placeholder="USPS">
                                    </div>
                                    <div class="form-group">
                                        <label>Code:</label>
                                        <input type="text" class="form-control" required name="code" value="{{$order->supplier_tracking->first()->courier_code}}" placeholder="usps">
                                    </div>
                                    <div class="form-group">
                                        <label>Number:</label>
                                        <input type="text" class="form-control" required name="number" value="{{$order->supplier_tracking->first()->number}}" placeholder="292232223332233">
                                    </div>
                                    <div class="form-group">
                                        <label>Shipping Cost:</label>
                                        <input type="text" class="form-control" required name="cost" value="{{$order->supplier_tracking->first()->cost_shipping}}" placeholder="59">
                                    </div>
                                    <div class="form-group">
                                        <label>Url:</label>
                                        <input type="url" class="form-control" required name="url" value="{{$order->supplier_tracking->first()->url}}" placeholder="https://example.com/#">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
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
                        <p style="font-size: 14px">{{$customer->first_name}} {{$customer->last_name}} </p>
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

    <!-- Modal -->
    <div class="modal fade" id="trackingmodal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Tracking Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">	<span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('supplier.order.fulfillment.process',$order->id)}}" method="post">
                    @csrf
                    <input type="hidden" value="{{$order->id}}" name="order_id">
                    <input type="hidden" value="{{auth()->user()->id}}" name="supplier_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" class="form-control" required name="name" placeholder="USPS">
                    </div>
                    <div class="form-group">
                        <label>Code:</label>
                        <input type="text" class="form-control" required name="code" placeholder="usps">
                    </div>
                    <div class="form-group">
                        <label>Number:</label>
                        <input type="text" class="form-control" required name="number" placeholder="292232223332233">
                    </div>
                    <div class="form-group">
                        <label>Shipping Cost:</label>
                        <input type="text" class="form-control" required name="cost" placeholder="59">
                    </div>
                    <div class="form-group">
                        <label>Url:</label>
                        <input type="url" class="form-control" required name="url" placeholder="https://example.com/#">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.index')
@section('content')
    <div class="row mb-3">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <span class="font-weight-bold font-20 vertical-align-middle"> {{$order->name}}'s Fulfillment</span>
        </div>
    </div>
    @include('layouts.flash_message')

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header block-header-default">
                    <h6 class="card-title">
                        Quantity to Fulfill
                    </h6>
                </div>
                <div class="card-body">
                    <p class="atleast-one-item alert alert-warning" style="display: none"> <i class="fa fa-exclamation-circle"></i> You need to fulfill at least 1 item.</p>
                    <table class="table table-borderless table-striped table-vcenter">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Items</th>
                            <th>Price</th>
                            <th style="width: 25%">Quantity</th>

                        </tr>
                        </thead>
                        <tbody>
                        <form id="fulfilment_process_form" action="{{route('supplier.order.fulfillment.process',$order->id)}}" method="post">
                            @csrf
                            @foreach($order->supplier_line_item as $item)
                                @if($item->fulfilled_by != 'store' && $item->fulfillable_quantity > 0)
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
                                        <td style="width: 30%">
                                            <p>{{$item->name}} <br> <span class="text-muted">SKU : {{$item->sku}}</span></p>
                                        </td>
                                        <td>  {{number_format($item->supplier_price,2)}} USD</td>
                                        <td><div class="form-group">
                                                <div class="input-group">
                                                    <input type="hidden" name="item_id[]" value="{{$item->id}}">
                                                    <input type="number" class="form-control fulfill_quantity" min="0" max="{{$item->fulfillable_quantity}}" name="item_fulfill_quantity[]" value="{{$item->fulfillable_quantity}}" readonly>
                                                    <div class="input-group-append">
                                                <span class="input-group-text">
                                                    of {{$item->fulfillable_quantity}}
                                                </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                @endif
                            @endforeach
                        </form>
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            {{--            <div class="text-right">--}}
            {{--                <button class="btn btn-primary">Manual Fulfill <i class="fa fa-question-circle"  title="Only use this in case order is already fulfilled in user shop."> </i></button>--}}
            {{--            </div>--}}
            @if($order->shipping_address != null)
                <div class="card">
                    <div class="card-header block-header-default">
                        <h6 class="card-title">
                            Shipping Address
                        </h6>

                    </div>
                    @php
                        $shipping = json_decode($order->shipping_address);
                    @endphp
                    <div class="card-body">
                        @if($shipping != null)
                            <p style="font-size: 14px">{{$shipping->first_name}} {{$shipping->last_name}}
                                @if($order->custom == 0)
                                    <br> {{$shipping->company}}
                                @endif
                                <br> {{$shipping->address1}}
                                <br> {{$shipping->address2}}
                                <br> {{$shipping->city}}
                                <br> {{$shipping->province}} {{$shipping->zip}}
                                <br> {{$shipping->country}}
                                @if($order->custom == 0)
                                    <br> {{$shipping->phone}}
                                @endif
                            </p>
                        @else
                            <p style="font-size: 14px"> No Shipping Address
                            </p>
                        @endif
                    </div>
                </div>
            @endif
            <div class="card">
                <div class="card-header block-header-default">
                    <h6 class="card-title">
                        Summary
                    </h6>
                </div>
                <div class="card-body">
                    <p>Fulfilling From Fulfillbot Logistics Office</p>
                    <p class="font-weight-bold"><span class="fulfillable_quantity_drop badge badge-pill bg-gray" data-total="{{count($order->supplier_line_item)}}" style="font-size: 13px">{{count($order->supplier_line_item)}} of {{count($order->supplier_line_item)}} </span> Mark as Fulfilled</p>
                    <hr>
                    <div class="row mb2">
                        <div class="col-md-12">
                            <button class="btn fulfill_items_btn btn-block btn-primary"> Fulfill Items</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

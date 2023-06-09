@extends('layouts.index')
@section('content')
    <div class="row mb-3">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <span class="font-weight-bold font-20 vertical-align-middle">Edit Product</span>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            <button class="btn btn-primary btn_save_my_product"> Save </button>
        </div>
    </div>
    @include('layouts.flash_message')

    <div class="content">
        <div class="card radius-15">
            <div class="card-body my_product_form_div">
                <h6> Basic Information</h6>
                <div class="row mb-2">
                    <div class="col-md-3">
                        <div class="js-gallery">
                            @php
                            $images = [];
                            @endphp
                            @if($product->has_images()->count() > 0)
                                @php
                                    $images = $product->has_images()->orderBy('position')->get();
                                    $image = $images[0];
                                @endphp
                                <a class="img-link img-link-zoom-in img-lightbox" href="{{asset($image->src)}}">
                                    <img class="img-fluid" src="{{asset($image->src)}}" alt="">
                                </a>
                            @else
                                <a class="img-link img-link-zoom-in img-lightbox" href="#">
                                    <img class="img-fluid" src="https://wfpl.org/wp-content/plugins/lightbox/images/No-image-found.jpg" alt="">
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-9">
                        <form action="{{route('import.product.update',$product->id)}}" method="post">
                            @csrf
                            <input type="hidden" name="request_type" value="basic-info">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title"
                                       value="{{$product->title}}">
                            </div>
                            <div class="form-group">
                                <label>Tags</label>
                                <input class="js-tags-input form-control" type="text"
                                       value="{{$product->tags}}" name="tags">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Type</label>
                                        <input type="text" class="form-control" name="type"
                                               value="{{$product->type}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Vendor</label>
                                        <input type="text" class="form-control" name="vendor"
                                               value="{{$product->vendor}}">
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <h6>Description</h6>
                <div class="row mb-2">
                    <div class="col-md-12">
                        <form action="{{route('import.product.update',$product->id)}}" method="post">
                            @csrf
                            <textarea class="summernote" name="description"
                                      placeholder="Please Enter Description here !">{{$product->description}}</textarea>
                        </form>
                    </div>
                </div>
                <h6>Images</h6>
                <div class="row mb-2">
                    <div class="col-md-12">
                        @if(count($images) >0)
                            <div class="row editable ">

                                @foreach($images as $image)
                                    <div class="col-md-3 mb2 preview-image animated fadeIn">
                                        <div class="options-container fx-img-zoom-in fx-opt-slide-right">
                                            <img class="img-fluid options-item" src="{{ asset($image->src)}}"
                                                 alt="">

                                            <div class="options-overlay bg-black-75">
                                                <div class="options-overlay-content">
                                                    <a class="btn btn-sm btn-danger delete-file"
                                                       data-type="existing-product-image-delete"
                                                       data-token="{{csrf_token()}}"
                                                       data-route="{{route('import.product.update',$product->id)}}"
                                                       data-file="{{$image->id}}"><i class="fa fa-times"></i> Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <hr>
                        @endif
                        <div class="row">
                            <form class="product-images-form"
                                  action="{{route('import.product.update',$product->id)}}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <form>
                                    <input type="hidden" name="request_type" value="existing-product-image-add">
                                    <div class="col-md-12">
                                        <div class="dropzone dz-clickable">
                                            <div class="dz-default dz-message">
                                                <span>Click here to upload images.</span></div>
                                            <div class="row preview-drop"></div>
                                        </div>
                                        <input style="display: none" type="file" name="images[]" accept="image/*"
                                               class="push-30-t push-30 dz-clickable images-upload" multiple>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
                <h6>Variants</h6>
                <div class="row mb-2">
                    <div class="col-md-12">
                        <table class="table table-hover table-borderless table-responsive">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th style="width: 15%;">Image</th>
                                <th>Price</th>
                                <th>Cost</th>
                                <th>
                                    <a class="calculate_shipping_btn btn btn-sm text-white btn-primary"
                                       {{--                                                   data-route="{{route('calculate_shipping')}}" data-product="{{$product->linked_product_id}}" --}}
                                       data-warehouse="{{ 3 }}" data-retailer-product="{{ $product->id }}"
                                       data-toggle="modal"
                                       data-target="#shipping_modal_{{$product->id}}">Shipping</a>
                                </th>
                                <div class="modal fade" id="shipping_modal_{{$product->id}}" tabindex="-1"
                                     role="dialog" aria-labelledby="modal-block-popout" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-popout" role="document">
                                        <div class="modal-content">
                                            <div class="block block-themed block-transparent mb-0">
                                                <div class="block-header bg-primary-dark">
                                                    <h3 class="block-title">Calculate Shipping Zone</h3>
                                                    <div class="block-options">
                                                        <button type="button" class="btn-block-option">
                                                            <i class="fa fa-fw fa-times" data-dismiss="modal"
                                                               aria-label="Close"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="block-content font-size-sm">
                                                    <div class="text-center loader-div p-2">
                                                        <h5>Calculating Shipping Price....</h5>
                                                        <img
                                                            data-src="https://i.ya-webdesign.com/images/shopping-transparent-animated-gif.gif"
                                                            alt="">
                                                    </div>
                                                    <div class="drop-content">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <th>Quantity</th>
                                <th>SKU</th>
                                </th>
                            </tr>
                            </thead>
                            @if(count($product->hasVariants) > 0)
                                @foreach($product->hasVariants as $index => $v)
                                    <form action="{{route('import.product.update',$product->id)}}" method="post">
                                        @csrf
                                        <input type="hidden" name="request_type" value="single-variant-update">
                                        <input type="hidden" name="variant_id" value="{{$v->id}}">
                                        <tbody>
                                        <tr>
                                            <td>
                                                <img class="img-avatar "
                                                     style="border: 1px solid whitesmoke; width: 100%;"
                                                     data-input=".varaint_file_input" data-toggle="modal"
                                                     data-target="#select_image_modal{{$v->id}}"
                                                     @if($v->has_image == null)  src="https://wfpl.org/wp-content/plugins/lightbox/images/No-image-found.jpg"
                                                     @else @if($v->has_image->isV == 0) src="{{asset($v->has_image->src)}}"
                                                     @else src="{{asset($v->has_image->src)}}" @endif @endif alt="">
                                                <div class="modal fade" id="select_image_modal{{ $v->id }}"
                                                     tabindex="-1" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Select Image For
                                                                    Variant</h5>
                                                                <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body font-size-sm">
                                                                <div class="row">
                                                                    @foreach($product->has_images as $image)
                                                                        <div class="col-md-4">
                                                                            @if($image->isV == 0)
                                                                                <img class="img-fluid options-item"
                                                                                     src="{{asset($image->src)}}"
                                                                                     alt="">
                                                                            @else
                                                                                <img class="img-fluid options-item"
                                                                                     src="{{asset($image->src)}}"
                                                                                     alt="">
                                                                            @endif
                                                                            <p style="cursor: pointer"
                                                                               data-image="{{$image->id}}"
                                                                               data-variant="{{$v->id}}"
                                                                               data-type="retailer"
                                                                               class="rounded-bottom bg-primary text-white choose-variant-image text-center">
                                                                                Choose</p>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="variant_title">
                                                @if($v->option1 != null) {{$v->option1}} @endif    @if($v->option2 != null)
                                                    / {{$v->option2}} @endif    @if($v->option3 != null)
                                                    / {{$v->option3}} @endif
                                            </td>
                                            <td>
                                                <input type="text"
                                                       class="form-control js-retailer-product-variant-price-update"
                                                       data-route="{{route('import.product.variant.price.update',$product->id)}}"
                                                       data-variant-id="{{ $v->id }}" name="price"
                                                       placeholder="$0.00" value="{{$v->price}}">
                                            </td>
                                            <td><input type="text" class="form-control" readonly
                                                       value="{{$v->cost}}" placeholder="$0.00"></td>
{{--                                            <td class="drop-shipping text-center">N/A</td>--}}
                                            <td><input type="text" readonly class="form-control"
                                                       value="{{$v->quantity}}" name="quantity" placeholder="0">
                                            </td>
                                            <td><input type="text" readonly class="form-control" name="sku"
                                                       value="{{$v->sku}}"></td>
                                            <td colspan="2">
                                            </td>
                                        </tr>
                                        </tbody>
                                    </form>
                                @endforeach
                            @else
                                <form action="{{route('import.product.update',$product->id)}}" method="post">
                                    @csrf
                                    <input type="hidden" name="request_type" value="default-variant-update">
                                    <tr>
                                        <td class="variant_title">
                                            Default
                                        </td>
                                        <td class="text-center">
                                            <img class="img-avatar " style="border: 1px solid whitesmoke"
                                                 src="{{ asset($image->src) }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control js-retailer-product-price-update"
                                                   data-route="{{route('import.product.variant.price.update',$product->id)}}"
                                                   data-product-id="{{ $product->id }}" name="price"
                                                   placeholder="$0.00" value="{{$product->price}}">
                                        </td>
                                        <td><input type="text" class="form-control" readonly
                                                   value="{{$product->cost}}" placeholder="$0.00"></td>
                                        <td class="drop-shipping text-center">N/A</td>

                                        <td><input type="text" readonly class="form-control"
                                                   value="{{$product->quantity}}" name="quantity" placeholder="0">
                                        </td>
                                        <td><input type="text" readonly class="form-control" name="sku"
                                                   value="{{$product->sku}}"></td>
                                        <td colspan="2">
                                            {{--                                                    @foreach($warehouses as $warehouse)--}}
                                            {{--                                                       @if($qty = $warehouse->has_inventory_quantity_for_product($product->linked_product))--}}
                                            {{--                                                            <div class="row mb-2">--}}
                                            {{--                                                                <div class="col-md-6">--}}
                                            {{--                                                                    <input  type="text" disabled class="form-control" value="{{ $warehouse->title }}">--}}
                                            {{--                                                                    <input  type="hidden" class="form-control" name="war_id[]" value="{{ $warehouse->id }}">--}}
                                            {{--                                                                </div>--}}
                                            {{--                                                                <div class="col-md-6">--}}
                                            {{--                                                                    <input  type="number" disabled class="form-control warhouse-qty-row" name="war_qty_for_single_variant[]" value="{{ $qty }}">--}}
                                            {{--                                                                </div>--}}
                                            {{--                                                            </div>--}}
                                            {{--                                                       @endif--}}
                                            {{--                                                    @endforeach--}}
                                        </td>
                                    </tr>
                                </form>

                            @endif
                        </table>
                        <div class="form-image-src" style="display: none">
                            @if(count($product->hasVariants) > 0)
                                @foreach($product->hasVariants as $index => $v)
                                    <form id="varaint_image_form_{{$index}}{{$v->id}}"
                                          action="{{route('import.product.update',$product->id)}}" method="post"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="request_type" value="variant-image-update">
                                        <input type="hidden" name="variant_id" value="{{$v->id}}">
                                        <input type="file" name="varaint_src" class="varaint_file_input"
                                               accept="image/*">
                                    </form>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-right">
                <button  class="btn btn-primary btn_save_my_product"> Save </button>
            </div>
        </div>
    </div>
@endsection

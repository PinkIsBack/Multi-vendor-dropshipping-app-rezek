@extends('layouts.index')
@section('content')
    <div class="row mb-3">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <span class="font-weight-bold font-20 vertical-align-middle">Import List</span>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            {{--            <a href="{{ route('product.create') }}" class="btn btn-primary btn-sm">Add product</a>--}}
        </div>
    </div>
    @include('layouts.flash_message')
    <form action="">
        <div class="row">
            <div class="col-md-12">
                <div class="input-group mb-3">
                    <input type="search" value="{{$search}}" name="search" placeholder="Search by keyword"
                           class="form-control h-100">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" >Search</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <p><b>Note: </b>For johannesburg and pretoria shipping rates are {{ \App\Helpers\AppHelper::currency() }} 59. All other locations are {{ \App\Helpers\AppHelper::currency() }} 99</p>
    @if(count($products) > 0)
        @foreach($products as $index => $product)

            <div class="card radius-15">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" href="#product_{{$product->id}}_products" data-toggle="tab"
                               role="tab">Product</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" href="#product_{{$product->id}}_variants" data-toggle="tab" role="tab">Pricing</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" href="#product_{{$product->id}}_images" data-toggle="tab" role="tab">Images</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" href="#product_{{$product->id}}_description" data-toggle="tab"
                               role="tab">Description</a>
                        </li>
                        <li class="nav-item ml-auto action_buttons_in_tabs">
                            <div class="block-options pl-3 pr-2">

                                <button class="btn btn-sm btn-primary btn_save_retailer_product" title="Save Product"
                                        data-tabs=".product_tab_panes_{{$index}}">Save
                                </button>
                                <button class="btn btn-sm btn-danger"
                                        onclick="window.location.href='{{route('import.product.delete',$product->id)}}'"
                                        title="Delete Product">Delete
                                </button>
                                <button
                                    onclick="window.location.href='{{route('import.product.shopify',$product->id)}}'"
                                    class="btn btn-sm btn-success">
                                    Push to Shop
                                </button>
                            </div>
                        </li>
                    </ul>
                    <div class="tab-content p-3 product_tab_panes_{{$index}}">
                        <div class="tab-pane fade active show" id="product_{{$product->id}}_products" role="tabpanel">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="js-gallery">
                                        @php
                                            $images = [];
                                            $image = '';
                                        @endphp
                                        @if($product->has_images()->count() > 0)
                                            @php
                                                $images = $product->has_images()->orderBy('position')->get();
                                                $image = $images[0];
                                            @endphp

                                            <a class="img-link img-link-zoom-in img-lightbox" href="{{$image->src}}">
                                                <img class="img-fluid" src="{{asset($image->src)}}" alt="">
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
                        </div>
                        <div class="tab-pane fade" id="product_{{$product->id}}_variants" role="tabpanel">
                            <table class="table table-hover table-borderless table-responsive">
                                <thead>
                                <tr>
                                    <th style="width: 15%;">Image</th>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th>Cost</th>
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
                                                     src="{{ asset(optional($image)->src) }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control js-retailer-product-price-update"
                                                       data-route="{{route('import.product.variant.price.update',$product->id)}}"
                                                       data-product-id="{{ $product->id }}" name="price"
                                                       placeholder="$0.00" value="{{$product->price}}">
                                            </td>
                                            <td><input type="text" class="form-control" readonly
                                                       value="{{$product->cost}}" placeholder="$0.00"></td>
{{--                                            <td class="drop-shipping text-center">N/A</td>--}}

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
                        <div class="tab-pane" id="product_{{$product->id}}_images" role="tabpanel">
                            <h6>Images</h6>
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
                        <div class="tab-pane" id="product_{{$product->id}}_description" role="tabpanel">
                            <form action="{{route('import.product.update',$product->id)}}" method="post">
                                @csrf
                                <textarea class="summernote" name="description"
                                          placeholder="Please Enter Description here !">{{$product->description}}</textarea>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        @endforeach
        <div class="row">
            <div class="col-md-12 text-right" style="font-size: 17px">
                {!! $products->links("pagination::bootstrap-4")!!}
            </div>
        </div>
    @else
        <div class="card radius-15">
            <div class="card-body">
                <p class="text-center"> No Products Found in Import List!</p>
            </div>
        </div>
    @endif
@endsection

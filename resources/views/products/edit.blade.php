@extends('layouts.index')
@section('content')
    <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <a href="{{ route('product.all') }}" class="btn btn-light btn-sm  mr-2"><i
                        class="bx bx-arrow-back font-20"></i></a><span
                    class="font-weight-bold font-20 vertical-align-middle">Edit Product</span>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-light btn-sm">Discard</a>
                <button class="btn btn-primary btn-sm submit-button">Save</button>
            </div>
        </div>
        @include('layouts.flash_message')
        <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="card radius-15">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Short Sleeve Shirt"
                                   value="{{ $product->title }}" required>
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="summernote"
                                      rows="5">{!! $product->description !!}</textarea>
                        </div>
                    </div>
                </div>

                <div class="card radius-15">
                    <div class="card-header ">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6"><h6 class="vertical-align-middle">Images</h6></div>
                            <div class="col-md-6 col-sm-6 col-xs-6 text-right ">
                                <a style="margin-left: 10px;" class="btn btn-sm btn-primary text-white"
                                   data-toggle="modal" data-target="#add_product_images">Add More Images</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(count($product->has_images) >0)
                            <div class="row editable" id="image-sortable" data-product="{{$product->id}}"
                                 data-route="{{route('product.update_image_position',$product->id)}}">
                                @foreach($product->has_images()->orderByRaw("CAST(position as UNSIGNED) ASC")->cursor() as $image)
                                    <div class="col-lg-4 preview-image animated fadeIn mb-2" data-id="{{$image->id}}"
                                         data-pos="{{ $image->position }}">
                                        <div class="options-container fx-img-zoom-in fx-opt-slide-right">
                                            <img class="img-fluid options-item" src="{{ asset($image->src)}}" alt="">
                                            <div class="options-overlay bg-black-75">
                                                <div class="options-overlay-content">
                                                    <a class="btn btn-sm btn-danger delete-file"
                                                       data-type="existing-product-image-delete"
                                                       data-token="{{csrf_token()}}"
                                                       data-route="{{route('product.delete.existing.image',$product->id)}}"
                                                       data-file="{{$image->id}}">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{----}}
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card radius-15">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" step="any" class="form-control" name="price"
                                           placeholder="$ 0.00" value="{{ $product->price }}" required="">
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label>Cost Per Item</label>
                                    <input type="number" step="any" class="form-control" name="cost"
                                           placeholder="$ 0.00" value="{{ $product->cost }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="number" step="any" class="form-control" name="quantity"
                                           placeholder="0" value="{{ $product->quantity }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Weight</label>
                                    <input type="number" step="any" class="form-control" name="weight"
                                           placeholder="0.0Kg" value="{{ $product->weight }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>SKU</label>
                                    <input type="text" class="form-control" name="sku" value="{{ $product->sku }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Barcode</label>
                                    <input type="text" class="form-control" name="barcode"
                                           value="{{ $product->barcode }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Length(cm)</label>
                                    <input type="number" step="any" class="form-control" name="length"
                                           value="{{$product->length}}" placeholder="0">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Width(cm)</label>
                                    <input type="number" step="any" class="form-control" name="width"
                                           value="{{$product->width}}" placeholder="0">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Height(cm)</label>
                                    <input type="number" step="any" class="form-control" name="height"
                                           value="{{$product->height}}" placeholder="0">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="card radius-15">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Product Status</label>
                            <select name="status" class="form-control">
                                <option value="0" @if($product->status == 0) selected @endif>Draft</option>
                                <option value="1" @if($product->status == 1) selected @endif>Active</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class=" mb-1">
                                <label>Created
                                    At: {{date_create($product->created_at)->format('d m, Y h:i a') }}</label>
                            </div>
                            <div class=" mb-1">
                                <label>Updated
                                    At: {{date_create($product->updated_at)->format('d m, Y h:i a') }}</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card radius-15">
                    <div class="card-body" style="max-height: 350px;overflow-y: auto;overflow-x: hidden;">
                        <h6>Category</h6>
                        <div class="form-group product_category">
                            @foreach($categories as $category)
                                {{--                                {{ dd($product->has_categories($product)) }}--}}
                                <span class="category_down" data-value="0" style="vertical-align: middle"><i
                                        class="bx bx-caret-right"></i></span>
                                <div class="custom-control custom-checkbox d-inline-block">
                                    <input type="checkbox" name="category[]" value="{{$category->id}}"
                                           class="custom-control-input category_checkbox"
                                           id="rowcat_{{$category->title}}"
                                           @if(in_array($category->id, $product->has_categories->pluck('id')->toArray())) checked @endif
                                    >
                                    <label class="custom-control-label"
                                           for="rowcat_{{$category->title}}">{{$category->title}}</label>
                                </div>
                                <div class="mt-1 ml-5 product_sub_cat" @if(count($product->has_subcategories) < 1)style="display: none" @endif>
                                    @foreach($category->has_subCategory as $sub)
                                        <div class="custom-control custom-checkbox d-inline-block">
                                            <input type="checkbox" name="sub_cat[]" value="{{$sub->id}}"
                                                   class="custom-control-input sub_cat_checkbox"
                                                   @if(in_array($sub->id,$product->has_subcategories->pluck('id')->toArray())) checked @endif
                                                   id="rowsub_{{$sub->title}}">
                                            <label class="custom-control-label"
                                                   for="rowsub_{{$sub->title}}">{{$sub->title}}</label>
                                        </div>
                                        <br>
                                    @endforeach
                                </div>
                                <br>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card radius-15">
                    <div class="card-body">
                        <h6 class="mb-3">Organization</h6>
                        <div class="form-group">
                            <label>Product Type</label>
                            <input type="text" class="form-control" name="product_type" placeholder="eg. Shirts"
                                   value="{{ $product->type }}">
                        </div>
                        <div class="form-group">
                            <label>Vendor</label>
                            <input type="text" class="form-control" name="vendor" placeholder="eg. Nike"
                                   value="{{ $product->vendor }}">
                        </div>
                        <div class="form-group">
                                <label>Tags</label>
                                <textarea class="js-tags-options-update options-preview form-control" type="text"
                                          id="product-meta-keywords" name="tags[]" >{{ $product->tags }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--Variants Section--}}
        <div class="row">
            <div class="col-md-12">
                @if($product->variants == 'on')
                    <div class="card radius-15">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                <h6>Variant</h6>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                    <a href="{{ route('product.existing_product_update_variants', $product->id) }}" class="btn btn-primary btn-sm">Update Variant</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="variants" id="val-terms"
                                           checked>
                                    <label class="custom-control-label" for="val-terms">This product has multiple
                                        options, like different sizes or colors</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <span class="">Bulk Update Pricing/Cost/Quantity</span>
                            <div class="row my-2">
                                <div class="col-md-3">
                                    <input id="bulk-var-price" type="number" class="form-control" placeholder="Price">
                                </div>
                                <div class="col-md-3">
                                    <input id="bulk-var-cost" type="number" class="form-control" placeholder="Cost">
                                </div>
                                <div class="col-md-3">
                                    <input id="bulk-var-qty" type="number" class="form-control" placeholder="Quantity">
                                </div>
                            </div>
                            <table class="table variants-div js-table-sections table-hover table-responsive">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Cost</th>
                                    <th>Quantity</th>
                                    <th>SKU</th>
                                    <th>Barcode</th>
                                    <th>Weight</th>
                                </tr>
                                </thead>
                                @if(count($product->hasVariants) > 0)
                                    @foreach($product->hasVariants as $index => $v)
                                        <input type="hidden" name="variant_id[]" value="{{$v->id}}">
                                        <tbody class="js-table-sections-header">
                                        <tr>
                                            <td class="variant_title">
                                                @if($v->option1 != null) {{$v->option1}} @endif    @if($v->option2 != null)
                                                    / {{$v->option2}} @endif    @if($v->option3 != null)
                                                    / {{$v->option3}} @endif
                                            </td>
                                            <td class="text-center">
                                                <img class="img-avatar"
                                                     style="width:100px;border: 1px solid whitesmoke"
                                                     data-input=".varaint_file_input" data-toggle="modal"
                                                     data-target="#select_image_modal{{$v->id}}"
                                                     @if($v->has_image == null)  src="https://wfpl.org/wp-content/plugins/lightbox/images/No-image-found.jpg"
                                                     @else @if($v->has_image->isV == 0) src="{{ asset($v->has_image->src) }}"
                                                     @else src="{{asset($v->has_image->src)}}"
                                                     @endif @endif alt="">
                                                <div class="modal " id="select_image_modal{{ $v->id }}" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Select Image For Variant</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                                <div class="modal-body font-size-sm">
                                                                    <div class="row">
                                                                        @foreach($product->has_images as $image)
                                                                            <div class="col-md-4">
                                                                                @if($image->isV == 0)
                                                                                    <img
                                                                                        class="img-fluid options-item"
                                                                                        src="{{asset($image->src)}}"
                                                                                        alt="">
                                                                                @else
                                                                                    <img
                                                                                        class="img-fluid options-item"
                                                                                        src="{{asset($image->src)}}"
                                                                                        alt="">
                                                                                @endif
                                                                                <p style="color: #ffffff;cursor: pointer"
                                                                                   data-image="{{$image->id}}"
                                                                                   data-variant="{{$v->id}}"
                                                                                   data-type="product"
                                                                                   class="rounded-bottom bg-primary choose-variant-image text-center">
                                                                                    Choose</p>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </td>
                                            <td>
                                                <input type="number" step="any" class="form-control var-price-row"
                                                       name="variant_price[]" placeholder="$0.00"
                                                       value="{{$v->price}}">
                                            </td>

                                            <td><input type="number" step="any" class="form-control var-cost-row"
                                                       name="variant_cost[]" value="{{$v->cost}}"
                                                       placeholder="$0.00"></td>
                                            <td><input type="number" step="any" class="form-control var-qty-row"
                                                       value="{{$v->quantity}}"
                                                       name="variant-quantity[]" placeholder="0"></td>
                                            <td><input type="text" class="form-control"
                                                       name="variant_sku[]" value="{{$v->sku}}"></td>
                                            <td><input type="text" class="form-control"
                                                       name="variant_barcode[]" value="{{$v->barcode}}"
                                                       placeholder="">
                                            <td><input type="number" step="any" class="form-control"
                                                       name="variant_weight[]" value="{{$v->weight}}"
                                                       placeholder=""></td>
                                        </tr>
                                        </tbody>
                                        <tbody>
                                        <tr>

                                            <td> @if($v->option1 != null) Option1: @endif</td>
                                            <td>
                                                @if($v->option1 != null)
                                                    <input type="text" class="form-control"
                                                           name="variant_option1[]" placeholder="$0.00"
                                                           value="{{$v->option1}}">
                                                @endif
                                            </td>
                                            <td style="vertical-align: middle">@if($v->option2 != null)
                                                    Option2: @endif</td>
                                            <td>
                                                @if($v->option2 != null)
                                                    <input type="text" class="form-control"
                                                           name="variant_option2[]" placeholder="$0.00"
                                                           value="{{$v->option2}}">
                                                @endif
                                            </td>
                                            <td style="vertical-align: middle">@if($v->option3 != null)
                                                    Option3: @endif</td>
                                            <td>
                                                @if($v->option3 != null)
                                                    <input type="text" class="form-control"
                                                           name="variant_option3[]" placeholder="$0.00"
                                                           value="{{$v->option3}}">
                                                @endif
                                            </td>

                                        </tr>
                                        </tbody>
                                    @endforeach
                                @endif
                            </table>
                        </div>
                    </div>
                @else
                    <div class="card radius-15">
                        <div class="card-body">
                            <h6>Variant</h6>
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-xs-6">
                                    <span class="font-weight-bold">No Variant Available For This Product</span>
                                </div>
                                <div class="col-sm-6 col-md-6 col-xs-6 text-right">
                                    <a href="{{route('product.new_variants',$product->id)}}"
                                       class="btn btn-primary btn-sm">Add New Variants</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                {{--Variants Section End--}}


                <div class="row mx-3">
                    <div class="col-sm-12 text-right">
                        <hr>
                        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-light btn-sm ">Discard</a>
                        <button class="btn btn-primary btn-sm submit-button">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="modal fade" id="add_product_images" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Images</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form class=" " action="{{route('product.add.images',$product->id)}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="row p-1">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="dropzone dz-clickable">
                                    <div class="dz-default dz-message"><span>Click here to upload images.</span></div>
                                    <div class="row preview-drop"></div>
                                </div>
                                <input style="display: none" type="file" name="images[]" accept="image/*"
                                       class="push-30-t push-30 dz-clickable images-upload" multiple>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


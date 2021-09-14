@extends('layouts.index')
@section('content')
    <form action="{{ route('product.save') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <a href="{{ route('product.all') }}" class="btn btn-light btn-sm  mr-2"><i class="bx bx-arrow-back font-20"></i></a><span class="font-weight-bold font-20 vertical-align-middle">Add Product</span>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                <a href="{{ route('product.create') }}" class="btn btn-light btn-sm">Discard</a>
                <button class="btn btn-primary btn-sm submit-button">Save</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="card radius-15">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Short Sleeve Shirt" required>
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="summernote" rows="5"></textarea>
                        </div>
                    </div>
                </div>

                <div class="card radius-15">
                    <div class="card-body">
                        <h6>Images</h6>
                        <div class="dropzone dz-clickable">
                            <div class="dz-default dz-message"><span>Click here to upload images.</span></div>
                            <div class="row preview-drop"></div>
                        </div>

                        <input style="display: none" accept="image/*" type="file" name="images[]"
                               class="push-30-t dz-hidden-input push-30 images-upload" multiple>
                    </div>
                </div>

                <div class="card radius-15">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" step="any" class="form-control" name="price"
                                           placeholder="{{ \App\Helpers\AppHelper::currency() }} 0.00" required="">
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label>Cost Per Item</label>
                                    <input type="number" step="any" class="form-control" name="cost"
                                           placeholder="{{ \App\Helpers\AppHelper::currency() }} 0.00">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                        <label>Quantity</label>
                                        <input type="number" step="any" class="form-control" name="quantity"
                                               placeholder="0" required="">
                                    </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                        <label>Weight</label>
                                        <input type="number" step="any" class="form-control" name="weight"
                                               placeholder="0.0Kg" required="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                        <label>SKU</label>
                                        <input type="text" class="form-control" name="sku" required="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                        <label>Barcode</label>
                                        <input type="text" class="form-control" name="barcode">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                        <label>Length(cm)</label>
                                        <input type="number" step="any" class="form-control" name="length" value="">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                        <label>Width(cm)</label>
                                        <input type="number" step="any" class="form-control" name="width" value="">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                        <label>Height(cm)</label>
                                        <input type="number" step="any" class="form-control" name="height" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card radius-15">
                    <div class="card-body">
                        <h6>Variant</h6>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="variants" id="val-terms">
                                <label class="custom-control-label" for="val-terms">This product has multiple options, like different sizes or colors</label>
                                </div>
                            </div>

                            <div class="variant_options mt-5" style="display: none;">
                                <h5 class="mb-3">Options</h5>
                                <div class="form-group">
                                    <div class="col-xs-12 push-10">
                                        <h6>Option 1</h6>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" placeholder="Attribute Name" name="attribute1">
                                            </div>
                                            <div class="col-sm-9">

                                                <input class="js-tags-options options-preview form-control" type="text"
                                                       id="product-meta-keywords" name="option1" value="">
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary btn-sm   option_btn_1 mt-2">
                                            Add another option
                                        </button>
                                    </div>
                                </div>
                                <div class="option_2" style="display: none;">
                                    <div class="form-group">
                                        <div class="col-xs-12 push-10">
                                            <h6>Option 2</h6>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" placeholder="Attribute Name" name="attribute2">
                                                </div>
                                                <div class="col-sm-9">
                                                    <input class="js-tags-options options-preview form-control" type="text"
                                                           id="product-meta-keywords" name="option2">
                                                </div>
                                            </div>
                                            <button type="button"
                                                    class="btn btn-primary btn-sm   option_btn_2 mt-2">Add another
                                                option
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="option_3" style="display: none;">
                                    <div class="form-group">
                                        <div class="col-xs-12 push-10">
                                            <h6>Option 3</h6>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" placeholder="Attribute Name" name="attribute3">
                                                </div>
                                                <div class="col-sm-9">
                                                    <input class="js-tags-options options-preview form-control" type="text"
                                                           id="product-meta-keywords" name="option3">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="variants_table" style="display: none;">
                                    <hr >
                                    <h5>Preview</h5>
                                    <div class="form-group">
                                        <div class="col-xs-12 push-10">
                                            <table class="table table-hover table-responsive">
                                                <thead>
                                                <tr>
                                                    <th style="width: 10%;">Title</th>
                                                    <th style="width: 20%;">Price</th>
                                                    <th style="width: 23%;">Cost</th>
                                                    <th style="width: 10%;">Quantity</th>
                                                    <th style="width: 20%;">SKU</th>
                                                    <th style="width: 20%;">Barcode</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
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
                                    <option value="0">Draft</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card radius-15">
                        <div class="card-body" style="max-height: 350px;overflow-y: auto;overflow-x: hidden;">
                            <h6>Category</h6>
                            <div class="form-group product_category">
                                @foreach($categories as $category)
                                    <span class="category_down" data-value="0" style="vertical-align: middle"><i class="bx bx-caret-right"></i></span>
                                    <div class="custom-control custom-checkbox d-inline-block">
                                        <input type="checkbox" name="category[]" value="{{$category->id}}" class="custom-control-input category_checkbox" id="rowcat_{{$category->title}}">
                                        <label class="custom-control-label" for="rowcat_{{$category->title}}">{{$category->title}}</label>
                                    </div>
                                    <div class="mt-1 ml-5 product_sub_cat" style="display: none">
                                            @foreach($category->has_subCategory as $sub)
                                                <div class="custom-control custom-checkbox d-inline-block">
                                                    <input type="checkbox" name="sub_cat[]" value="{{$sub->id}}" class="custom-control-input sub_cat_checkbox" id="rowsub_{{$sub->title}}">
                                                    <label class="custom-control-label" for="rowsub_{{$sub->title}}">{{$sub->title}}</label>
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
                                <input type="text" class="form-control" name="product_type" placeholder="eg. Shirts">
                            </div>
                            <div class="form-group">
                                <label>Vendor</label>
                                <input type="text" class="form-control" name="vendor" placeholder="eg. Nike">
                            </div>
                            <div class="form-group">
                                <div class="form-material form-material-primary">
                                    <label>Tags</label>
                                    <textarea class="js-tags-options options-preview form-control" type="text"
                                              id="product-meta-keywords" name="tags[]" value=""></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="row mx-3">
            <div class="col-sm-12 text-right">
                <hr>
                <a href="{{ route('product.create') }}" class="btn btn-light btn-sm ">Discard</a>
                <button class="btn btn-primary btn-sm submit-button">Save</button>
            </div>
        </div>
        </form>
    @endsection


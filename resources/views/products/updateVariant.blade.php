@extends('layouts.index')
@section('content')
    <input type="number" name="cost" value="{{$product->cost}}" style="display: none">
    <input type="number" name="price" value="{{$product->price}}" style="display: none">
    <input type="text" name="sku" value="{{$product->sku}}" style="display: none">
    <input type="number" name="quantity" value="{{$product->quantity}}" style="display: none">
    <form action="{{route('product.update.new_variants', $product->id)}}" method="post">
        @csrf
        <div class="row mb-3">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-light btn-sm  mr-2"><i
                        class="bx bx-arrow-back font-20"></i></a><span
                    class="font-weight-bold font-20 vertical-align-middle">Update Variant</span>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                <div class="submit-div">
                    <a href="{{ route('product.create') }}" class="btn btn-light btn-sm">Discard</a>
                    <button class="btn btn-primary btn-sm submit-button">Save</button>
                </div>
            </div>
        </div>
        <input type="hidden" name="type" value="existing-product-update-variants">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h6>Variant</h6>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="variants" id="val-terms" @if(isset($product->variants)) checked @endif>
                                <label class="custom-control-label" for="val-terms">This product has multiple options, like different sizes or colors</label>
                            </div>
                        </div>
                        <div class="variant_options" style="">
                            <h5 class="mb-3">Options</h5>
                            <div class="form-group">
                                @if(isset($product->option1))
                                    <div class="col-xs-12 push-10">
                                        <h6>Option 1</h6>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" placeholder="Attribute Name" name="attribute1" value="{{ $product->attribute1 }}">
                                            </div>
                                            <div class="col-sm-9">
                                                <input class="js-tags-options options-preview form-control" type="text"
                                                       id="product-meta-keywords" name="option1" value="{{  $product->option1 }}">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                    @if(!isset($product->option2))
                                        <button type="button" class="btn btn-primary btn-sm option_btn_1 mt-2">Add another option</button>
                                    @endif
                            </div>
                            <div class="form-group">
                                @if(isset($product->option2))
                                    <div class="col-xs-12 push-10">
                                        <h6>Option 2</h6>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" placeholder="Attribute Name" name="attribute2" value="{{ $product->attribute2 }}">
                                            </div>
                                            <div class="col-sm-9">
                                                <input class="js-tags-options options-preview form-control" type="text"
                                                       id="product-meta-keywords" name="option2" value="{{ $product->option2 }}">
                                            </div>
                                        </div>
                                    </div>

                                    @if(!isset($product->option3))
                                    <button type="button" class="btn btn-primary btn-sm option_btn_2 mt-2">Add another option</button>
                                    @endif
                                @endif
                            </div>
                            <div class="form-group">
                                @if(isset($product->option3))
                                    <div class="col-xs-12 push-10">
                                        <h6>Option 3</h6>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" placeholder="Attribute Name" name="attribute3" value="{{ $product->attribute3 }}">
                                            </div>
                                            <div class="col-sm-9">
                                                <input class="js-tags-options options-preview form-control" type="text"
                                                       id="product-meta-keywords" name="option3" value="{{ $product->option3 }}">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="option_2" style="display: none;">
                                <hr>
                                <div class="form-group">
                                    <div class="col-xs-12 push-10">
                                        <h6>Option 2</h6>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="attribute2" value="{{ $product->attribute2 }}">
                                            </div>
                                            <div class="col-sm-9">
                                                <input class="js-tags-options options-preview form-control" type="text"
                                                       id="product-meta-keywords" name="option2">
                                            </div>
                                        </div>
                                        <button type="button"
                                                class="btn btn-primary btn-sm option_btn_2 mt-2">Add another
                                            option
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="option_3" style="display: none;">
                                <hr>
                                <div class="form-group">
                                    <div class="col-xs-12 push-10">
                                        <h6>Option 3</h6>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="attribute3" value="{{ $product->attribute3 }}">
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
                                <hr>
                                <h5 >Preview</h5>
                                <div class="form-group">
                                    <div class="col-xs-12 push-10">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th style="width: 20%;">Title</th>
                                                <th style="width: 15%;">Price</th>
                                                <th style="width: 17%;">Cost</th>
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
        </div>
    </form>
@endsection


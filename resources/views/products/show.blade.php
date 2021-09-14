@extends('layouts.index')
@section('content')
    <div class="row mb-3">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <a href="{{ route('product.all') }}" class="btn btn-light btn-sm  mr-2"><i
                    class="bx bx-arrow-back font-20"></i></a>
            <span class="font-weight-bold font-20 vertical-align-middle">{{ $product->title }}</span>
        </div>
    </div>
    <!--Section: Block Content-->
    <div class="card radius-15">
        <div class="card-body">

            <div class="row">
                <div class="col-md-6 mb-4 mb-md-0">

                    <div class="row js-gallery">
                        <?php
                        if (count($product->has_images) > 0) {
                            $images = \App\Models\ProductImage::where('product_id', $product->id)->orderByRaw("CAST(position as UNSIGNED) ASC")->get();
                        } else {
                            $images = [];
                        }
                        ?>

                        <div class="col-md-12 text-center">
                            @if(count($images) > 0)
                                <img class="img-fluid" src="{{ asset($images[0]->src)}}" alt="">
                            @else
                                <img class="img-avatar2"
                                     src="https://wfpl.org/wp-content/plugins/lightbox/images/No-image-found.jpg">
                            @endif
                        </div>
                        @if(count($images) > 0)
                            @foreach($images as $image)
                                <div class="col-md-3">
                                    <img class="img-fluid" src="{{asset($image->src)}}" alt="">
                                </div>
                            @endforeach
                        @endif
                    </div>

                </div>
                <div class="col-md-6">

                    <h5>{{ $product->title }}</h5>
                    {{--                <p class="mb-2 text-muted text-uppercase small">Shirts</p>--}}
                    <div class="row">
                        <div class="col-md-6">
                            @if($product->quantity > 0)

                                @if(count($product->hasVariants) > 0)
                                    <span class="text-primary">IN STOCK</span><br>
                                    <small>{{$product->hasVariants()->sum('quantity')}} Available
                                        in {{count($product->hasVariants)}} Variants</small>
                                @elseif($product->quantity > 0)
                                    <span class="text-success">IN STOCK</span><br><small>{{$product->quantity}}
                                        Available </small>
                                @else
                                    <span class="text-danger">OUT OF STOCK</span><br><small>Not Available</small>
                                @endif
                            @else
                                <span class="text-danger">OUT OF STOCK</span><br><small>Not Available</small>
                            @endif
                        </div>
                        <div class="col-md-6 text-right">
                            <span class="text-primary font-weight-bold">{{ \App\Helpers\AppHelper::currency() }}{{number_format($product->price,2)}}</span>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless mb-0">
                            <tbody>
                            @if($product->tags != null)
                                <tr>
                                    <th class="pl-0 w-25" scope="row"><strong>Tags</strong></th>
                                    <td>@foreach(explode(',', $product->tags) as $tag)
                                            <span class="badge badge-primary">{{ $tag }}</span>
                                        @endforeach</td>
                                </tr>
                            @endif

                            @if(count($product->has_categories) > 0)
                                <tr>
                                    <th class="pl-0 w-25" scope="row"><strong>Category</strong></th>
                                    <td>@foreach($product->has_categories as $cat)
                                            <span class="badge badge-primary">{{$cat->title}}</span>
                                        @endforeach</td>
                                </tr>
                            @endif

                            @if(count($product->has_subcategories) > 0)
                                <tr>
                                    <th class="pl-0 w-25" scope="row"><strong>SubCategory</strong></th>
                                    <td>@foreach($product->has_subcategories as $subcat)
                                            <span class="badge badge-primary">{{$subcat->title}}</span>
                                        @endforeach</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <p class="pt-1">{!! $product->description !!}</p>
                </div>
            </div>

        </div>
    </div>
    <div class="card radius-15">
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation"><a class="nav-link active" id="variant_tab" data-toggle="tab"
                                                            href="#variants" role="tab" aria-controls="variants"
                                                            aria-selected="true">Variants</a>
                </li>
                <li class="nav-item" role="presentation"><a class="nav-link" id="information-tab" data-toggle="tab"
                                                            href="#information" role="tab" aria-controls="information"
                                                            aria-selected="false">Information</a>
                </li>
            </ul>
            <div class="tab-content p-3" id="myTabContent">
                <div class="tab-pane fade active show" id="variants" role="tabpanel" aria-labelledby="variant_tab">
                    @if(count($product->hasVariants) > 0)
                        <table class="table table-striped table-borderless remove-margin-b">
                            <thead>
                            <tr>
                                <th style="width: 10%;">Image</th>
                                <th style="width: 45%;">Title</th>
                                <th style="width: 15%;">Quantity</th>
                                <th style="width: 15%;">Price</th>
                                <th style="width: 15%;">Cost</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($product->hasVariants as $index => $variant)
                                <tr>
                                    <td>
                                        <img class="img-thumbnail"
                                             @if($variant->has_image == null)  src="https://wfpl.org/wp-content/plugins/lightbox/images/No-image-found.jpg"
                                             @else src="{{ asset($variant->has_image->src) }}"
                                             @endif alt="">
                                    </td>
                                    <td class="variant_title">
                                        @if($variant->option1 != null) {{$variant->option1}} @endif    @if($variant->option2 != null)
                                            / {{$variant->option2}} @endif    @if($variant->option3 != null)
                                            / {{$variant->option3}} @endif
                                    </td>
                                    <td>
                                        @if($variant->quantity >0)
                                            {{$variant->quantity}}
                                        @else
                                            Out of Stock
                                        @endif
                                    </td>
                                    <td>{{ \App\Helpers\AppHelper::currency() }}{{number_format($variant->price,2)}}</td>
                                    <td>{{ \App\Helpers\AppHelper::currency() }}{{number_format($variant->cost,2)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>This Product has Zero Variants</p>
                    @endif
                </div>
                <div class="tab-pane fade" id="information" role="tabpanel" aria-labelledby="information-tab">
                    <h5>Additional Information</h5>
                    <table class="table table-striped table-bordered mt-3">
                        <thead>
                        <tr>
                            <th scope="row" class="w-150 dark-grey-text h6">Weight</th>
                            <td><em>@if(isset($product->weight)) {{ $product->weight }}kg @else NA @endif</em></td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row" class="w-150 dark-grey-text h6">Dimensions</th>
                            <td><em>{{ $product->length }} × {{ $product->width }} × {{ $product->height }} cm</em></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.index')
@section('content')
    <div class="row mb-3">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <span class="font-weight-bold font-20 vertical-align-middle">Products</span>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            {{--            <a href="{{ route('product.create') }}" class="btn btn-primary btn-sm">Add product</a>--}}
        </div>
    </div>
    @include('layouts.flash_message')
<div class="row ml-1 mb-3">
    @foreach($categories as $category)
    <div class="col-md-3 bg-white py-2" style="border-right: 1px solid #e5e5ec;border-bottom: 1px solid #e5e5ec;">
        <a href="{{ route('product.all') }}?category={{ $category->title }}">
            <p class="m-0"><img class="img-avatar pr-2" src="{{ asset($category->img) }}" alt=""> {{ $category->title }}</p>
        </a>
    </div>
    @endforeach
</div>
    <form action="">
        <div class="row mb-3">
            <div class="col-md-10 pr-0">
                <input type="search" value="{{$search}}" name="search" placeholder="Search By Keyword"
                       class="form-control h-100">
            </div>
            <div class="col-md-2 pl-0">
                <button type="submit" class="btn btn-block btn-primary h-100"><i class="fa fa-search"
                                                                                 style="margin-right: 5px"></i>Search
                </button>
            </div>

        </div>
    </form>
    @if(count($products) > 0)
        <div class="row">
            @foreach($products as $index => $product)
                <div class="col-12 col-lg-3 col-xl-3">
                    <div class="card">
                        <div class="">
                        @if(count($product->has_images) > 0)
                            @foreach($product->has_images()->orderBy('position')->get() as $index => $image)
                                @if($index == 0)
                                    <img class="card-img-top" src="{{asset($image->src) }}" style="height: 255px;">
                                @endif
                            @endforeach
                        @else
                            <img class="card-img-top"
                                 src="https://wfpl.org/wp-content/plugins/lightbox/images/No-image-found.jpg" style="height: 255px;">
                        @endif
                        </div>
                        <div class="card-body">
                            <h5 class="card-title" style="font-size: 0.9rem;height: 38px;overflow: hidden;"><a href="{{ route('product.detail', $product->id) }}" class="text-dark text-capitalize">{{ $product->title }}</a></h5>
                            <p class="card-text">{{ \App\Helpers\AppHelper::currency() }}{{ number_format($product->c_price, 2) }}</p>
                            <a href="{{ route('import.product.merchant', $product->id) }}" class="btn btn-sm btn-block btn-primary">Import</a>
                        <span class="text-muted font-small">Fulfilled by ZADropship</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12 text-right" style="font-size: 17px">
                {!! $products->appends(request()->input())->render() !!}
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-body">
                <p class="text-center"> No Products Found in List!</p>
            </div>
        </div>
    @endif
@endsection


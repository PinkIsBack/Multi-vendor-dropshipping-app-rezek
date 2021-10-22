@extends('layouts.index')
@section('content')
    <div class="row mb-3">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <span class="font-weight-bold font-20 vertical-align-middle">My Products</span>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            {{--            <a href="{{ route('product.create') }}" class="btn btn-primary btn-sm">Add product</a>--}}
        </div>
    </div>
    @include('layouts.flash_message')
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
                        @if(count($product->has_images) > 0)
                            @foreach($product->has_images()->orderBy('position')->get() as $index => $image)
                                @if($index == 0)
                                    <img class="card-img-top" src="{{asset($image->src) }}" style="height: 255px;">
                                @endif
                            @endforeach
                        @else
                            <img class="card-img-top" src="https://wfpl.org/wp-content/plugins/lightbox/images/No-image-found.jpg" style="height: 255px;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title" style="font-size: 0.9rem;height: 38px;overflow: hidden;"><a href="{{ route('my.product.detail', $product->id) }}" class="text-dark text-capitalize">{{ $product->title }}</a></h5>
                            <p class="card-text">{{ \App\Helpers\AppHelper::currency() }}{{ $product->price }}</p>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('my.product.detail', $product->id) }}" class="btn btn-primary">View</a>
                                <button class="btn btn-primary" onclick="window.location.href='{{route('my.product.edit',$product->id)}}'" title="Delete Product">Edit</button>
                                <button class="btn btn-primary" onclick="window.location.href='{{route('import.product.delete',$product->id)}}'" title="Delete Product">Delete</button>
                            </div>
                            <br>
                            <span class="text-muted font-small">by ZADropship</span>
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
        <div class="card radius-15">
            <div class="card-body ">
                <p class="text-center"> No Products Found in Dropship List!</p>
            </div>
        </div>
    @endif
@endsection

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
    <form action="">
        <div class="row">
            <div class="col-md-12">
                <div class="input-group mb-3">
                    <input type="search" value="{{$search}}" name="search" placeholder="Search by Product title"
                           class="form-control h-100">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" >Search</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @if(count($products) > 0)
        <form action="">
    <div class="card radius-15">
        <div class="card-header action-div" style="display: none">
            <div class="  col-6">

                <div class="input-group mb-3">
                    <select class="form-control" name="status_id" id="">
                        @foreach(\App\Models\ProductStatus::all() as $status)
                            <option value="{{$status->id}}">{{$status->title}}</option>
                        @endforeach
                    </select><div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </div>



            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th scope="col"><input type="checkbox" class="all-checkbox"></th>
                        <th scope="col">#</th>
                        <th scope="col"></th>
                        <th scope="col">Title</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Status</th>
                        <th scope="col">Created At</th>
                        <th scope="col"></th>

                    </tr>
                    </thead>
                    <tbody>

                    @foreach($products as $index => $product)
                        <tr>
                            <td><input type="checkbox" name="products_id[]" value="{{$product->id}}" class="input-checkbox"></td>
                            <td>{{ ++$index }}</td>
                            <td>
                                <a>@if(count($product->has_images) > 0)
                                        @foreach($product->has_images()->orderBy('position')->get() as $index => $image)
                                            @if($index == 0)
                                                <img class="img-avatar2" style="max-width:100px;border: 1px solid whitesmoke" src="{{asset($image->src) }}">
                                            @endif
                                        @endforeach
                                    @else
                                        <img class="img-avatar2" style="max-width:100px;border: 1px solid whitesmoke" src="https://wfpl.org/wp-content/plugins/lightbox/images/No-image-found.jpg">
                                    @endif
                                </a>
                            </td>
                            <td>
                                <a>{{ $product->title }}</a>
                            </td>

                            <td>From.
                                @if(count($product->hasVariants) > 0)
                                    {{ \App\Helpers\AppHelper::currency() }}{{ number_format($product->hasVariants->min('price'), 2) }}
                                @else
                                    {{ \App\Helpers\AppHelper::currency() }}{{ number_format($product->price, 2) }}
                                @endif
                            </td>
                            <td>
                                @if($product->quantity > 0)
                                    @if(count($product->hasVariants) > 0)
                                        {{$product->hasVariants->sum('quantity')}}
                                    @else
                                        {{$product->quantity}}
                                    @endif
                                @else
                                    {{$product->quantity}}
                                @endif
                            </td>
                            <td style="position: relative;">
                                <button type="button" class="btn bg-transparent p-0 admin_status_btn"><span class="badge badge-primary p-2" style="background: {{ $product->has_status->bg_color }}">{{ $product->has_status->title }}</span> <span class="bx bx-caret-down" ></span>
                                </button>
                                <div name="product_status" class="bg-light p-2" style="display: none; position: absolute; z-index: 99;top: 40%;left: 75%;">
                                    @foreach(\App\Models\ProductStatus::all() as $status)
                                    <a href="{{ route('product.admin.change.status', [$product->id, $status->id]) }}" class="text-black-50">{{ $status->title }}</a>
                                        <br>
                                    @endforeach
                                </div>
                            </td>
                            <td>{{date_create($product->created_at)->format('d m, Y h:i a') }}</td>
                            <td class="text-right">
                                <a href="{{ route('product.detail', $product->id) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <a href="{{ route('product.delete', $product->id) }}" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        </form>
    <div class="pagination">
        {{ $products->links("pagination::bootstrap-4") }}
    </div>
    @else
        <div class="card">
            <div class="card-body ">
                <p class="text-center"> No Products Found in List!</p>
            </div>
        </div>
    @endif


@endsection

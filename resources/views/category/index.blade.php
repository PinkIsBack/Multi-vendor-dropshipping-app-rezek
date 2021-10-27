@extends('layouts.index')
@section('content')
    <div class="row mb-3">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <span class="font-weight-bold font-20 vertical-align-middle">Categories</span>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            <a href="{{ route('category.create') }}" class="btn btn-primary btn-sm">Add category</a>
        </div>
    </div>
    @include('layouts.flash_message')
    <div id="accordion1" class="accordion">
        <div class="card radius-15">
            @foreach($categories as $i=>$category)
                <div class="card-header collapsed" data-toggle="collapse" href="#category{{ $category->id }}"
                     aria-expanded="false">
                    <div class="row">
                        <div class="col-md-1">
                            <img
                                src="@if(isset($category->img)) {{ asset($category->img) }} @else https://wfpl.org/wp-content/plugins/lightbox/images/No-image-found.jpg @endif"
                                alt="{{ $category->title }}" class="img-fluid cursor-pointer">
                        </div>
                        <div class="col-md-4 cursor-pointer">
                            {{ $category->title }}
                        </div>
                        <div class="col-md-4">
                            <span class="badge badge-primary cursor-pointer">{{ $category->slug }}</span>
                        </div>
                        <div class="col-md-3 text-right">

                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-sm btn-primary" data-toggle="modal" title="Add Sub-category" data-target="#newSubCategory"><i class="bx bx-plus "></i>
                                </button>
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#updatecategory{{ $category->id }}"><i class="bx bx-pencil"></i></button>
                                <a href="{{ route('category.delete', $category->id) }}?type=category"
                                   class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="category{{ $category->id }}" class="card-body collapse" data-parent="#accordion1" style="">
                    @foreach($category->has_subCategory as $sub)
                        <div class="row mx-5 my-2">
                            <div class="col-md-1">
                                <img
                                    src="@if(isset($sub->img)) {{ asset($sub->img) }} @else https://wfpl.org/wp-content/plugins/lightbox/images/No-image-found.jpg @endif"
                                    alt="{{ $sub->title }}" class="img-fluid cursor-pointer">
                            </div>
                            <div class="col-md-4 cursor-pointer">
                                {{ $sub->title }}
                            </div>
                            <div class="col-md-4">
                                <span class="badge badge-primary cursor-pointer">{{ $sub->slug }}</span>
                            </div>
                            <div class="col-md-3 text-right">
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#updatesubcategory{{ $sub->id }}">Edit</button>
                                    <a href="{{ route('category.delete', $sub->id) }}?type=subcategory"
                                       class="btn btn-danger">Delete</a>
                                </div>
                            </div>
                        </div>

                        {{--  Update sub category--}}
                        <div class="modal fade" id="updatesubcategory{{ $sub->id }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit SubCategory</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>


                                    <form method="POST" action="{{ route('category.update', $sub->id) }}?type=updateSubCategory"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-8 col-md-8">
                                                    <div class="form-group">
                                                        <label>Title</label>
                                                        <input type="text" name="title" class="form-control" value="{{ $sub->title }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Slug</label>
                                                        <input type="text" name="slug" class="form-control" value="{{ $sub->slug }}">
                                                    </div>
                                                </div>

                                                <div class="col-xs-12 col-sm-4 col-md-4 text-center">
                                                    <img src="{{ $sub->img }}" alt="Category Image"
                                                         class="category_img_displayed mb-2 pb-3 h-50"
                                                         style="width:100%; @if(!isset($sub->img)) display: none; @endif">
                                                    <button type="button" class="btn btn-primary category_image">select Image to
                                                        upload
                                                    </button>
                                                    <input type="file" class="category_image_upload d-none"
                                                           name="img">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                            </button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{--  Update category--}}
                <div class="modal fade" id="updatecategory{{ $category->id }}" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>


                            <form method="POST" action="{{ route('category.update', $category->id) }}?type=updateCategory"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-8 col-md-8">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" name="title" class="form-control" value="{{ $category->title }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Slug</label>
                                                <input type="text" name="slug" class="form-control" value="{{ $category->slug }}">
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-4 col-md-4 text-center">
                                            <img src="{{ $category->img }}" alt="Category Image"
                                                 class="category_img_displayed mb-2 pb-3 h-50"
                                                 style="width:100%; @if(!isset($category->img)) display: none; @endif">
                                            <button type="button" class="btn btn-primary category_image">select Image to
                                                upload
                                            </button>
                                            <input type="file" class="category_image_upload d-none"
                                                   name="img">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                    </button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                {{--  New Sub category--}}
                <div class="modal fade" id="newSubCategory" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Create New SubCategory</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>


                            <form method="POST" action="{{ route('category.update', $category->id) }}?type=newSubCategory"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-8 col-md-8">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" name="title" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>Slug</label>
                                                <input type="text" name="slug" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-4 col-md-4 text-center">
                                            <img src="" alt="Category Image"
                                                 class="category_img_displayed mb-2 pb-3 h-50"
                                                 style="width:100%;display: none;">
                                            <button type="button" class="btn btn-primary category_image">select Image to
                                                upload
                                            </button>
                                            <input type="file" class="category_image_upload d-none"
                                                   name="img">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                    </button>
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

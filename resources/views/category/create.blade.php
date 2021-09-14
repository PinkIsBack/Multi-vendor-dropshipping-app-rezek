@extends('layouts.index')
@section('content')
    <div class="row mb-3">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <a href="{{ route('category.all') }}" class="btn btn-light btn-sm  mr-2"><i class="bx bx-arrow-back font-20"></i></a><span class="font-weight-bold font-20 vertical-align-middle">Add Category</span>
        </div>
    </div>

    <form action="{{ route('category.save') }}" method="post" enctype="multipart/form-data">
        @csrf
    <div class="card radius-15">
        <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Slug</label>
                            <input type="text" name="slug" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4 text-center">

                        <img src="" alt="Category Image" class="category_img_displayed mb-2 pb-3 h-50" style="width:100%;display: none;">
                        <button type="button" class="btn btn-primary category_image">select Image to upload</button>
                        <input type="file" class="category_image_upload d-none" name="category_img">
                    </div>
                </div>
            <button type="button" class="btn btn-primary add_sub_category">Add SubCategory</button>
            <div class="sub_category">

            </div>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
    </form>

    <div class="copy_sub_category d-none">
        <hr>
        <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="sub_category_title[]" class="form-control">
            </div>

            <div class="form-group">
                <label>Slug</label>
                <input type="text" name="sub_category_slug[]" class="form-control">
            </div>
        </div>
        <div class="col-md-4 text-center">

            <img src="" alt="Category Image" class="category_img_displayed mb-2 pb-3 h-50" style="width:100%;display: none;">
            <button type="button" class="btn btn-primary category_image">select Image to upload</button>
            <input type="file" class="category_image_upload d-none" name="sub_category_img[]">
        </div>
        </div>
    </div>
@endsection

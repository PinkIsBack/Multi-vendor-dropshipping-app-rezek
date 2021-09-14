@extends('layouts.index')
@section('content')
    <div class="row mb-3">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <span class="font-weight-bold font-20 vertical-align-middle">Profile</span>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            <button type="button" class="btn btn-primary btn-sm edit_profile_btn">Edit Profile
            </button>
        </div>
    </div>
    @include('layouts.flash_message')
    <div class="card radius-15">
        <div class="card-body">
            <div class="row user_profile">
                <div class="col-12 col-lg-7 border-right">
                    <div class="d-md-flex align-items-center">
                        <div class="mb-md-0 mb-3">
                            <img src="@if(isset($user->profile_img)) {{ asset($user->profile_img) }} @else https://via.placeholder.com/110x110 @endif" class="rounded-circle shadow" width="130" height="130" alt="">
                        </div>
                        <div class="ml-md-4 flex-grow-1">
                            <div class="d-flex align-items-center mb-1">
                                <h4 class="mb-0">{{ $user->name }}</h4>
                            </div>
                            <p class="mb-0 text-muted">{{ $user->business_name }}</p>
                            <p class="text-primary"><i class="bx bx-phone"></i>{{ $user->phone }}</p>
                            <p class="text-muted">{{ $user->email }}</p>
                            <p class="text-muted">{{ $user->address1 }} {{ $user->address2 }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-5">
                    <table class="table table-sm table-borderless mt-md-0 mt-3">
                        <tbody>
                        <tr>
                            <th>City:</th>
                            <td>{{ $user->city }}</td>
                        </tr>
                        <tr>
                            <th>State:</th>
                            <td>{{ $user->state }}</td>
                        </tr>
                        <tr>
                            <th>Country:</th>
                            <td>{{ $user->country }}</td>
                        </tr>
                        <tr>
                            <th>Zip Code:</th>
                            <td>{{ $user->zip }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="user_profile_edit_form" style="display: none">
            <form action="{{ route('user.profile.update', $user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="row">
                <div class="col-md-3 text-center">
                    <img  src="@if(isset($user->profile_img)) {{ asset($user->profile_img) }} @else https://via.placeholder.com/110x110 @endif" class="rounded-circle shadow category_img_displayed" width="130" height="130">
                    <br>
                    <button type="button" class="btn btn-sm btn-primary category_image mt-3">Upload Image</button>
                    <input type="file" class="category_image_upload d-none" name="profile_img">
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" readonly>
                    </div>

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" @role('Merchant') readonly @endrole>
                    </div>
                    <div class="form-group">
                        <label>Business Name</label>
                        <input type="text" name="business_name" class="form-control" value="{{ $user->business_name }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="number" class="form-control" name="phone" value="{{ $user->phone }}">
                    </div>
                    <div class="form-group">
                        <label>Address 1</label>
                        <input type="text" class="form-control" name="address1" placeholder="Street Address" value="{{ $user->address1 }}">
                    </div>
                    <div class="form-group">
                        <label>Address 2</label>
                        <input type="text" class="form-control" placeholder="apartment suit etc" name="address2" value="{{ $user->address2 }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" class="form-control" name="city" value="{{ $user->city }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>State</label>
                        <input type="text" class="form-control" name="state" value="{{ $user->state }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Zip</label>
                        <input type="text" class="form-control" name="zip" value="{{ $user->zip }}">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Country</label>
                        <input type="text" class="form-control" name="country" value="{{ $user->country }}">
                    </div>
                </div>
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </div>
            </div>
            </form>
            </div>
        </div>
    </div>
@endsection

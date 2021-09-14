@extends('layouts.index')
@section('content')
    <div class="row mb-3">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <span class="font-weight-bold font-20 vertical-align-middle">Shipping Areas</span>
        </div>
    </div>
    @include('layouts.flash_message')
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="card radius-15">
                <div class="card-body">
                    <form action="{{ route('shipping.areas.save') }}?type=state" method="post">
                        @csrf
                        <div class="form-group">
                            <label>State</label>
                            <input type="text" name="title" class="form-control" placeholder="State Name" required>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-sm btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="card radius-15">
                <div class="card-body">
                    <form action="{{ route('shipping.areas.save') }}?type=city" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Select State</label>
                            <select name="state" class="form-control">
                                @if(count($states) > 0)
                                    @foreach($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->title }}</option>
                                    @endforeach
                                @else
                                    <option>No States Available</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="city[]" placeholder="City Name">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-primary text-white add_new_city"
                                          style="cursor: pointer;">+ Add City</span>
                                </div>
                            </div>
                        </div>
                        <div class="append_city">

                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-sm btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div id="accordion1" class="accordion">
                <div class="card radius-15">
                    @foreach($states as $i=>$state)
                        <div class="card-header collapsed" data-toggle="collapse" href="#category{{ $state->id }}"
                             aria-expanded="false">
                            <div class="row">
                                <div class="col-md-6 cursor-pointer">
                                    {{ $state->title }}
                                </div>
                                <div class="col-md-6 text-right">
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-sm btn-primary" data-toggle="modal"
                                                data-target="#updatecategory{{ $state->id }}">Edit
                                        </button>
                                        <a href="{{ route('shipping.areas.delete', $state->id) }}?type=state"
                                           class="btn btn-sm btn-danger">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="category{{ $state->id }}" class="card-body collapse border-bottom" data-parent="#accordion1">
                            @foreach($state->has_city as $i=>$city)
                                <div class="row mx-3 my-2">
                                    <div class="col-md-6 cursor-pointer">
                                       {{ ++$i }} - {{ $city->title }}
                                    </div>

                                    <div class="col-md-6 text-right">
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-sm btn-primary" data-toggle="modal"
                                                    data-target="#city{{ $city->id }}">Edit
                                            </button>
                                            <a href="{{ route('shipping.areas.delete', $city->id) }}?type=city" class="btn btn-sm btn-danger">Delete</a>
                                        </div>
                                    </div>
                                </div>
                                {{-- Update City--}}
                                <div class="modal fade" id="city{{ $city->id }}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit City</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="{{ route('shipping.areas.update', $city->id) }}?type=city"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                                            <div class="form-group">
                                                                <label>Title</label>
                                                                <input type="text" name="title" class="form-control" value="{{ $city->title }}">
                                                            </div>
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

                        {{--  Update State--}}
                    <div class="modal fade" id="updatecategory{{ $state->id }}" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit State</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <form method="POST" action="{{ route('shipping.areas.update', $state->id) }}?type=state" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                                                            <div class="form-group">
                                                                                <label>State</label>
                                                                                <input type="text" name="title" class="form-control" value="{{ $state->title }}">
                                                                            </div>
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
            </div>
        </div>
    </div>
@endsection

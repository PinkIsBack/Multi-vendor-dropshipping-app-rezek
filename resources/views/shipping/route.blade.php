@extends('layouts.index')
@section('content')
    <div class="row mb-3">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <span class="font-weight-bold font-20 vertical-align-middle">Shipping Route</span>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#newRoute">Add Route</button>
        </div>
    </div>
    @include('layouts.flash_message')
    <div class="card radius-15">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th class="text-center">Origin</th>
                        <th class="text-center">Destination</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Processing Time</th>
                        <th class="text-center">Shipping Time</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($routes as  $i=>$route)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td class="text-center">{{ $route->origin->title }}</td>
                            <td class="text-center">{{ $route->destination->title }}</td>
                            <td class="text-center">{{ \App\Helpers\AppHelper::currency() }} @if(isset($route->price)){{ $route->price }}@else 0.00 @endif</td>
                            <td class="text-center">@if(isset($route->processing_time)){{ $route->processing_time }} day @else NA @endif</td>
                            <td class="text-center">@if(isset($route->shipping_time)){{ $route->shipping_time }} day @else NA @endif</td>

                            <td class="text-right">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#route{{ $route->id }}">Edit</button>
                                <a href="{{ route('shipping.routes.delete', $route->id) }}" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
{{--                         User Edit--}}
                        <div class="modal fade" id="route{{ $route->id }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Route</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('shipping.routes.update', $route->id) }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Origin</label>
                                                        <select name="orgin" class="form-control">
                                                            @foreach($cities as $city)
                                                                <option value="{{ $city->id }}" @if($route->origin_city_id == $city->id) selected @endif>{{ $city->title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Destination</label>
                                                        <select name="destination" class="form-control">
                                                            @foreach($cities as $city)
                                                                <option value="{{ $city->id }}" @if($route->destination_city_id == $city->id) selected @endif>{{ $city->title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <label>Price</label>
                                                        <input type="number" class="form-control" value="{{ $route->price }}" name="price" placeholder="{{ \App\Helpers\AppHelper::currency() }} 0.00" required>
                                                    </div>
                                                </div>

                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Processing Time</label>
                                                        <input type="number" name="processing_time" class="form-control" placeholder="Number of Days" value="{{ $route->processing_time }}">
                                                    </div>
                                                </div>

                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Shipping Time</label>
                                                        <input type="number" name="shipping_time" class="form-control" placeholder="Number of Days" value="{{ $route->shipping_time }}">
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
                    </tbody>
                </table>

            </div>
        </div>
    </div>


    {{--Create New Route--}}
    <div class="modal fade" id="newRoute" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Route</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form action="{{ route('shipping.routes.save') }}" method="post">
                    @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label>Origin</label>
                                <select name="orgin" class="form-control">
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label>Destination</label>
                                <select name="destination" class="form-control">
                                    @foreach($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" class="form-control" name="price" placeholder="{{ \App\Helpers\AppHelper::currency() }} 0.00" required>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label>Processing Time</label>
                                <input type="number" name="processing_time" class="form-control" placeholder="Number of Days">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label>Shipping Time</label>
                                <input type="number" name="shipping_time" class="form-control" placeholder="Number of Days">
                            </div>
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
@endsection

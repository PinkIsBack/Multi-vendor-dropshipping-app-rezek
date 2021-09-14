@extends('layouts.index')
@section('content')
    <div class="row mb-3">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <span class="font-weight-bold font-20 vertical-align-middle">Product Status</span>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                    data-target="#newRole">Add Status
            </button>
        </div>
    </div>
    @include('layouts.flash_message')
    <div class="card radius-15">
        <div class="card-body">
            <div class="card-title">
                <h4 class="mb-0">Status</h4>
            </div>
            {{--            <hr>--}}
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th style="width: 20%;">Title</th>
                        <th style="width: 15%;">Background Color</th>
                        <th style="width: 15%;">Text Color</th>
                        <th style="width: 25%;">Notes</th>
                        <th class="text-right" style="width: 10%;">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($statuses as $i => $status)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $status->title }}</td>
                            <td><span class="badge badge-danger" style="background-color: {{ $status->bg_color }} !important; width: 50%;">
                                   <i style="opacity: 0;">Ahmad</i>
                               </span></td>
                            <td><span class="badge badge-danger" style="width: 50%; background-color: {{ $status->text_color }} !important; border: 1px solid black;">
                                   <i style="opacity: 0;">Ahmad</i>
                               </span></td>
                            <td>{{ $status->notes }}</td>
                            <td class="text-right">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#status{{ $status->id }}">Edit
                                </button>
                                <a href="{{ route('productstatus.delete', $status->id) }}" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                        <div class="modal fade" id="status{{ $status->id }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Product Status</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    {!! Form::model($status, ['method' => 'PATCH','route' => ['productstatus.update', $status->id]]) !!}
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <input type="text" class="form-control" name="title" value="{{ $status->title }}">
                                                </div>

                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                                        <div class="form-group">
                                                            <label>Background Color</label>
                                                            <input type="color" name="bg_color" class="form-control" value="{{ $status->bg_color }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                                        <div class="form-group">
                                                            <label>Text Color</label>
                                                            <input type="color" name="text_color" class="form-control" value="{{ $status->text_color }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Note</label>
                                                    <textarea name="notes" class="form-control">{{ $status->notes }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                        </button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{--Create New Role--}}
    <div class="modal fade" id="newRole" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Product Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>


                {!! Form::open(array('route' => 'productstatus.save','method'=>'POST')) !!}
                <div class="modal-body">

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title">
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label>Background Color</label>
                                        <input type="color" name="bg_color" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label>Text Color</label>
                                        <input type="color" name="text_color" class="form-control" value="#ffffff">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Note</label>
                                <textarea name="notes" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                    </button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

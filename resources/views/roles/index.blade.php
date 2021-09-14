@extends('layouts.index')
@section('content')
    <div class="row mb-3">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <span class="font-weight-bold font-20 vertical-align-middle">Roles</span>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                    data-target="#newRole">Add Role
            </button>
        </div>
    </div>
    @include('layouts.flash_message')
    <div class="card radius-15">
        <div class="card-body">
            <div class="card-title">
                <h4 class="mb-0">Roles</h4>
            </div>
            {{--            <hr>--}}
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($roles as $key => $role)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $role->name }}</td>
                            <td class="text-right">
                                {{--                                <a class="btn btn-sm btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>--}}
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#role{{ $role->id }}">Edit
                                </button>
                                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        {{-- Role Edit--}}
                        <div class="modal fade" id="role{{ $role->id }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Role</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>

                                    {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
                                    <div class="modal-body">

                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    {!! Form::text('name', null, array('placeholder' => 'Role Title','class' => 'form-control')) !!}
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

                {!! $roles->render() !!}
            </div>
        </div>
    </div>
{{--Create New Role--}}
    <div class="modal fade" id="newRole" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>


                {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
                <div class="modal-body">

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label>Title</label>
                                {!! Form::text('name', null, array('placeholder' => 'Role Title','class' => 'form-control')) !!}
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

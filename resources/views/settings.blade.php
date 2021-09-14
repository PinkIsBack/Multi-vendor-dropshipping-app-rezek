@extends('layouts.index')
@section('content')
    <div class="row mb-3">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <span class="font-weight-bold font-20 vertical-align-middle">Default Settings</span>
        </div>
    </div>
    @include('layouts.flash_message')
    <div class="card radius-15">
        <div class="card-body">
            <form action="{{ route('setting.save') }}" method="post">
                @csrf
                <div class="form-group">
                    <label>Margin</label>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" name="margin" @if(isset($setting)) value="{{ $setting->margin }}" @endif required>
                        <div class="input-group-append">
                            <span class="input-group-text bg-primary text-white">%</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Currency Label</label>
                    <input type="text" name="currency_label" class="form-control" placeholder="USD" @if(isset($setting)) value="{{ $setting->currency_label }}" @endif required>
                </div>
                <div class="form-group">
                    <label>Currency Sign</label>
                    <input type="text" name="currency_sign" class="form-control" placeholder="$" @if(isset($setting)) value="{{ $setting->currency }}" @endif required>
                </div>
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary">@if(isset($setting)) Update @else Save @endif</button>
                </div>
            </form>
        </div>
    </div>
@endsection

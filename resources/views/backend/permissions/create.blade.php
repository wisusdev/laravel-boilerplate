@extends('layouts.app')
@push('title', __('global.permissions.title'))
@section('content')
    <div class="container py-3">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    {{__('global.create')}}
                    <div>
                        <a href="{{route('permissions.index')}}" class="btn btn-outline-primary btn-sm">{{__('global.return_back')}}</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('permissions.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">{{__('global.name')}}</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required class="form-control">
                        <p class="help-block"></p>
                        @if($errors->has('name'))
                            <p class="help-block">
                                {{ $errors->first('name') }}
                            </p>
                        @endif
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">{{ __('global.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop


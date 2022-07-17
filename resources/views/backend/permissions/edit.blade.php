@extends('layouts.app')
@push('title', __('global.permissions.title'))
@section('content')    
    <div class="container py-3">
        <div class="card mt-3">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    {{__('global.edit')}}
                    <div>
                        <a href="{{route('permissions.index')}}" class="btn btn-outline-primary btn-sm">{{__('global.return_back')}}</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('permissions.update', $permission->id)}}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="name">{{__('global.name')}}</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $permission->name) }}" required class="form-control">
                        <p class="help-block"></p>
                        @if($errors->has('name'))
                            <p class="help-block">
                                {{ $errors->first('name') }}
                            </p>
                        @endif
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-block">{{ __('global.update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop


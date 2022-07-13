@extends('layouts.app')
@push('title', __('global.permissions.title'))
@section('content')

    <form action="{{route('permissions.store')}}" method="post">
        @csrf

        <div class="card mt-3">
            <div class="card-header">
                {{__('global.create')}}
            </div>        
            <div class="card-body">
                <div class="form-group">
                    <label for="name">{{__('global.roles.fields.name')}}</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required class="form-control">
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-block">{{ __('global.save') }}</button>
            </div>
        </div>

    </form>
@stop


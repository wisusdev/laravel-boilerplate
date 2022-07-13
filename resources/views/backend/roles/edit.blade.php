@extends('layouts.app')
@push('title', __('global.roles.title'))
@section('content')
    
    <form action="{{route('roles.update', $role->id)}}" method="post">
        @method('PUT')
        @csrf

        <div class="card">
            <div class="card-header">
                {{__('global.edit')}}
            </div>

            <div class="card-body">

                <div class="form-group">
                    <label for="name">{{__('global.roles.fields.name')}}</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $role->name) }}" required class="form-control">
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="permission">{{__('global.roles.fields.permission')}}</label>
                    <select class="form-control select2WithoutTags" multiple id="permission" name="permission[]" value="{{ old('permission') }}" required>
                        @foreach ($permissions as $permission)
                            <option value="{{$permission}}" {{ collect(old('permission', optional($role->permissions)->pluck('name')))->contains($permission) ? 'selected' : '' }}>{{$permission}}</option>
                        @endforeach
                    </select>
                    <p class="help-block"></p>
                    @if($errors->has('permission'))
                        <p class="help-block">
                            {{ $errors->first('permission') }}
                        </p>
                    @endif
                </div>
         
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-block">{{ __('global.update') }}</button>
            </div>
        </div>

    </form>
@stop


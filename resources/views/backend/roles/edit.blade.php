@extends('layouts.app')
@push('title', __('global.roles.title'))
@section('content')
    <div class="container py-3">
        <div class="card">
            <div class="card-header">
                {{__('global.edit')}}
            </div>

            <div class="card-body">
                <form action="{{route('roles.update', $role->id)}}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">{{__('global.name')}}</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $role->name) }}" required class="form-control">
                        <p class="help-block"></p>
                        @if($errors->has('name'))
                            <p class="help-block">
                                {{ $errors->first('name') }}
                            </p>
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <label for="permission" class="form-label">{{__('global.permission')}}</label>
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

                    <button type="submit" class="btn btn-primary btn-block">{{ __('global.update') }}</button>
                </form>
            </div>
        </div>
    </div>
@stop


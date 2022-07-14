@extends('layouts.app')
@push('title', __('global.roles.title'))
@section('content')
    <div class="container py-3">
        <div class="card">
            <div class="card-header">
                {{__('global.create')}}
            </div>

            <div class="card-body">
                <form action="{{route('roles.store')}}" method="post">
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

                    <div class="form-group">
                        <label for="permission">{{__('global.permission')}}</label>
                        <select class="form-control" multiple id="permission" name="permission[]" value="{{ old('permission') }}" required>
                            @foreach ($permissions as $permission)
                                <option value="{{$permission}}">{{$permission}}</option>
                            @endforeach
                        </select>
                        <p class="help-block"></p>
                        @if($errors->has('permission'))
                            <p class="help-block">
                                {{ $errors->first('permission') }}
                            </p>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">{{ __('global.save') }}</button>

                </form>
            </div>
        </div>
    </div>
@stop


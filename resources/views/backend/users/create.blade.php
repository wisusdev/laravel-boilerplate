@extends('layouts.app')

@section('content')
    <div class="container py-3">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        {{__('global.users.title')}}
                    </div>
                    <div>
                        <a href="{{ route('users.index') }}" class="btn btn-primary" title="{{__('global.return_back')}}">
                            <i class="fa fa-undo" aria-hidden="true"></i> {{__('global.return_back')}}
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">

                <form method="POST" action="{{ route('users.store') }}" accept-charset="UTF-8" id="create_users_form" name="create_users_form" class="form-horizontal">
                    @csrf
                    <div class="mb-3 {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input class="form-control" name="name" type="text" id="name" value="{{ old('name')}}" minlength="1" maxlength="255" required="true" >
                        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                    </div>

                    <div class="mb-3 {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>
                        <input class="form-control" name="email" type="email" id="email" value="{{ old('email') }}" minlength="1" maxlength="255" required="true">
                        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                    </div>

                    <div class="mb-3 {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input class="form-control" name="password" type="password" id="password" minlength="5" maxlength="50" required="true">
                        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                    </div>

                    <div class="mb-3 {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label for="password" class="form-label">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                    </div>

                    <div class="mb-3 {{ $errors->has('role') ? ' has-error' : '' }}">
                        <label for="menu" class="form-label" >Roles</label>
                        <select multiple="" class="form-control select2WithoutTags" id="roles" name="roles[]">
                            @foreach ($roles as $key => $role)
                                <option value="{{ $role }}" {{ old('roles[]') }}>
                                    {{ $role }}
                                </option>
                            @endforeach
                        </select>
                        {!! $errors->first('roles', '<p class="help-block">:message</p>') !!}
                    </div>

                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" value="{{__('global.add')}}">
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection



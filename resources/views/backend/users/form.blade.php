<div class="mb-3 {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="form-label">{{__('global.name')}}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($user)->name) }}" minlength="1" maxlength="255" required="true" placeholder="Enter name here...">
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>

<div class="mb-3 {{ $errors->has('username') ? 'has-error' : '' }}">
    <label for="username" class="form-label">{{__('global.username')}}</label>
    <input class="form-control" name="username" type="text" id="username" value="{{ old('username', optional($user)->username) }}" minlength="1" maxlength="255" required="true" placeholder="Enter username here...">
    {!! $errors->first('username', '<p class="help-block">:message</p>') !!}
</div>

<div class="mb-3 {{ $errors->has('email') ? 'has-error' : '' }}">
    <label for="email" class="form-label">{{__('global.email')}}</label>
    <input class="form-control" name="email" type="text" id="email" value="{{ old('email', optional($user)->email) }}" minlength="1" maxlength="255" required="true" placeholder="Enter email here...">
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>


@if(empty($user))
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
@endif

<div class="mb-3 {{ $errors->has('role') ? ' has-error' : '' }}">
    <label for="roles" class="form-label">{{__('global.roles')}}</label>
    <select multiple="" class="form-control select2WithoutTags" id="roles" name="roles[]">
        @foreach ($roles as $key => $role)
            @if($user)
                <option value="{{ $role }}" {{ old('roles[]', optional($user)->roles->contains($key)) == $key ? 'selected' : '' }}>{{ $role }}</option>
            @else
                <option value="{{$key}}">{{$role}}</option>
            @endif
        @endforeach
    </select>
    {!! $errors->first('roles', '<p class="help-block">:message</p>') !!}
</div>


@extends('layouts.app')

@section('content')
	<div class="d-flex min-vh-75 align-items-center">
		<div class="container">
			<div class="row justify-content-center">
				@include('components.validate')
				<div class="col-md-4">
					<div class="card">
						<div class="card-header">
							<p class="m-0 fw-bold">{{__('Register')}}</p>
						</div>
						<div class="card-body">

							<form action="{{ route('register') }}" method="POST">
								@csrf
								<div class="form-group mb-3">
									<input type="text" placeholder="{{__('Name')}}" id="name" class="form-control" name="name"
										   required autofocus value="{{ old('name') }}">
									@if ($errors->has('name'))
										<span class="text-danger">{{ $errors->first('name') }}</span>
									@endif
								</div>

								<div class="form-group mb-3">
									<input type="text" placeholder="{{__('Username')}}" id="username" class="form-control"
										   name="username" required autofocus value="{{ old('username') }}">
									@if ($errors->has('username'))
										<span class="text-danger">{{ $errors->first('username') }}</span>
									@endif
								</div>

								<div class="form-group mb-3">
									<input type="text" placeholder="{{__('E-Mail Address')}}" id="email" class="form-control" name="email"
										   required autofocus value="{{ old('email') }}">
									@if ($errors->has('email'))
										<span class="text-danger">{{ $errors->first('email') }}</span>
									@endif
								</div>

								<div class="form-group mb-3">
									<input type="password" placeholder="{{__('Password')}}" id="password" class="form-control" name="password" required>
									@if ($errors->has('password'))
										<span class="text-danger">{{ $errors->first('password') }}</span>
									@endif
								</div>

								<div class="input-group mb-3">
									<input id="password_confirmation" type="password" placeholder="{{ __('Confirm Password') }}" class="form-control" name="password_confirmation" required>
									@if ($errors->has('password_confirmation'))
										<span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
									@endif
								</div>

								<div class="form-group mb-3">
									<div class="checkbox">
										<label><input type="checkbox" name="remember"> {{__('Remember Me')}}</label>
									</div>
								</div>

								<div class="d-grid mx-auto">
									<button type="submit" class="btn btn-dark btn-block">{{__('Sign up')}}</button>
								</div>
							</form>

							@include('frontend.auth.social-auth')
							<hr>
							<div class="d-flex justify-content-between">
								<a href="{{ route('login') }}" class="text-center text-decoration-none">{{__('global.i_have_an_account')}}</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@extends('layouts.app')
@section('content')
	<div class="d-flex min-vh-75 align-items-center">
		<div class="container ">
			<div class="row justify-content-center">
				<div class="col-md-4">
					<div class="card">
						<div class="card-header">{{ __('Reset Password') }}</div>

						<div class="card-body">
							<form method="POST" action="{{ route('password.update') }}">
								@csrf

								<input type="hidden" name="token" value="{{ $token }}">

								<div class="input-group mb-3">
									<input id="email" name="email" type="email" class="form-control" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required>
									<span class="input-group-text" id="email"><i class="bi bi-envelope"></i></span>
								</div>

								<div class="input-group mb-3">
									<input id="password" name="password" type="password" class="form-control" placeholder="{{ __('Password') }}" required>
									<span class="input-group-text" id="email"><i class="bi bi-key"></i></span>
								</div>

								<div class="input-group mb-3">
									<input id="password-confirm" name="password_confirmation" type="password" class="form-control" placeholder="{{ __('Confirm Password') }}" required>
									<span class="input-group-text" id="email"><i class="bi bi-key"></i></span>
								</div>


								<div class="form-group row mb-0">
									<div class="col-md-6 offset-md-4">
										<button type="submit" class="btn btn-primary">
											{{ __('Reset Password') }}
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

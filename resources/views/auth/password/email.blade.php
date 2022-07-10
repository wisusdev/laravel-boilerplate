@extends('layouts.app')
@section('content')
	<div class="d-flex min-vh-75 align-items-center">
		<div class="container ">
			<div class="row justify-content-center">
				<div class="col-md-4">
					<div class="card">
						<div class="card-header text-center font-weight-bold">{{ __('Reset Password') }}</div>
						<div class="card-body">
							@if (session('status'))
								<div class="alert alert-success" role="alert">
									{{ session('status') }}
								</div>
							@endif

							<form method="POST" action="{{ route('password.email') }}">
								@csrf

								<div class="input-group mb-3">
									<input id="email" name="email" type="email" class="form-control" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}">
									<span class="input-group-text" id="email"><i class="bi bi-envelope"></i></span>
								</div>

								<div class="form-group d-flex justify-content-end">
									<button type="submit" class="btn btn-primary">{{ __('Send Password Reset Link') }}</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

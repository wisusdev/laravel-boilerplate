<nav class="navbar navbar-expand-lg navbar-dark bg-black">
	<div class="container">
		<a href="{{route('welcome')}}" class="navbar-brand font-weight-bold">
			{{ config('app.name') }}
		</a>
		<!--<a class="navbar-brand" href="#">Navbar</a>-->
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto">

			</ul>
			<ul class="navbar-nav mb-2 mb-lg-0 ms-auto">

				@guest
					<li class="nav-item">
						<a class="nav-link" href="{{route('login')}}">{{__('Login')}}</a>
					</li>
					@if (Route::has('register'))
						<li class="nav-item">
							<a class="nav-link" href="{{route('register')}}">{{__('Register')}}</a>
						</li>
					@endif
				@else
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
						</a>
						<ul class="dropdown-menu dropdown-menu-start" aria-labelledby="navbarDropdown">
							<li><a class="dropdown-item" href="#">Something else here</a></li>
							<li><hr class="dropdown-divider"></li>
							<li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a></li>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
						</ul>
					</li>
				@endguest
			</ul>
		</div>
	</div>
</nav>

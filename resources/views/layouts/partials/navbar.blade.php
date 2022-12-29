<nav class="navbar navbar-expand-lg navbar-dark bg-black">
	<div class="container">
		<a href="{{route('home')}}" class="navbar-brand font-weight-bold">
			@if(Schema::hasTable('setting'))
				<img src="{{setting('logo')}}" alt="logo" class="img-fluid logo-nav">
			@else
				{{ config('app.name') }}
			@endif
		</a>
		<!--<a class="navbar-brand" href="#">Navbar</a>-->
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarMain">
			<ul class="navbar-nav me-auto">

			</ul>
			<ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarLang" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						<i class="bi bi-translate"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarLang">
						@if (config('envi.status') && count(config('envi.languages')) > 1)
							@foreach (array_keys(config('envi.languages')) as $lang)
								@if ($lang != App::getLocale())
									<a class="dropdown-item" href="{!! route('lang.swap', $lang) !!}">
										{{ strtoupper($lang) }} - {{ config('envi.languages')[$lang][3] }}
									</a>
								@endif
							@endforeach
						@endif
					</div>
				</li>
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
							@can('setting.index')
								<li><a class="dropdown-item {{ request()->routeIs('setting.index') ? 'active' : ''}}" href="{{ route('setting.index') }}">{{__('global.setting')}}</a></li>
							@endcan

							@can('env.index')
								<li><a class="dropdown-item {{ request()->routeIs('env.index') ? 'active' : ''}}" href="{{ route('env.index') }}">{{__('global.env')}}</a></li>
							@endcan

							@can('role.index')
								<li><a class="dropdown-item {{ request()->routeIs('roles.index') ? 'active' : ''}}" href="{{ route('roles.index') }}">{{__('global.roles')}}</a></li>
							@endcan
							
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

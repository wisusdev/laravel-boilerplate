<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container">
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link {{ request()->routeIs('users.index') ? 'active' : ''}}" href="{{route('users.index')}}"><i class="bi bi-person"></i> {{__('global.users')}}</a>
				</li>

				<li class="nav-item">
					<a class="nav-link {{ request()->routeIs('addons.index') ? 'active' : ''}}" href="{{route('addons.index')}}"><i class="bi bi-puzzle-fill"></i> {{__('global.addons')}}</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
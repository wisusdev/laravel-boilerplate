@foreach (['danger', 'warning', 'success', 'info'] as $key)
	@if(Session::has($key))
		<div class="alert alert-{{ $key }} alert-dismissible fade show">
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			<p class="mb-0">{{ Session::get($key) }}</p>
		</div>
	@endif
@endforeach
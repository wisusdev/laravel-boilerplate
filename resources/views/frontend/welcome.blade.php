@extends('layouts.app')
@section('content')
	<section class="h-75 d-flex align-items-center">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<h2 class="display-2">Never Stop To </h2>
					<h3 class="fs-1">Exploring The World</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat.
					</p>
					<a href="{{ route('home') }}" class="btn btn-outline-dark">Explore</a>
				</div>
			</div>
		</div>
	</section>
@endsection
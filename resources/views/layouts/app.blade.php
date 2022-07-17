<!DOCTYPE html>
<html lang="es">
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>{{ config('app.name') }}</title>
	<link href="{{asset('css/app.css')}}" rel="stylesheet">
</head>

<body class="d-flex flex-column vh-100 bg-white">
	<div class="flex-fill" id="app">
		@include('layouts.partials.navbar')

		@includeWhen(Auth::user(), 'backend.partials.navbar')

		@include('components.alert')

		@yield('content')
	</div>

	@include('layouts.partials.footer')

	<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
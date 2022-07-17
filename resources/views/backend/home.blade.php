@extends('layouts.app')
@section('content')
	<div class="container py-3">
		<div class="row">
			<div class="col-md-3">
				<div class="card">
					<div class="card-body">
						<h4 class="text-center"><a href="{{route('users.index')}}" class="text-decoration-none">{{__('global.users')}}</a></h4>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card">
					<div class="card-body">
						<h4 class="text-center"><a href="{{route('setting.index')}}" class="text-decoration-none">{{__('global.setting')}}</a></h4>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card">
					<div class="card-body">
						<h4 class="text-center"><a href="{{route('env.index')}}" class="text-decoration-none">{{__('global.env')}}</a></h4>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card">
					<div class="card-body">
						<h4 class="text-center"><a href="{{route('roles.index')}}" class="text-decoration-none">{{__('global.roles')}}</a></h4>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
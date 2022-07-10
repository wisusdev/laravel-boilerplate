<div class="bg-light">
	<footer class="py-3 my-4">
		<div class="container justify-content-center border-bottom pb-3 mb-3">
			<div class="row align-items-center">
				<div class="col-12 col-md-3 text-center text-md-start">
					<a href="{{route('home')}}" class="text-decoration-none">
						{{ config('app.name') }}
					</a>
				</div>
				<div class="col-12 col-md-6 text-center ">
					<span>Copyright &copy; <?php echo date("Y"); ?> - {{__('All rights reserved.')}}</span>
				</div>
				<div class="col-12 col-md-3 text-center text-md-end">

				</div>
			</div>
		</div>
	</footer>
</div>
<div class="social-auth-links my-3">
	<p class="text-center">- {{__('global.or')}} -</p>

	<div class="d-flex justify-content-between">
		<a href="{{ route('social.oauth', 'facebook') }}" class="btn btn-primary btn-block">
			<i class="fab fa-facebook mr-2"></i> Facebook
		</a>

		<a href="{{ route('social.oauth', 'twitter') }}" class="btn btn-info btn-block">
			<i class="fab fa-twitter mr-2"></i> Twitter
		</a>

		<a href="{{ route('social.oauth', 'google') }}" class="btn btn-danger btn-block">
			<i class="fab fa-google-plus mr-2"></i> Google
		</a>

		<a href="{{ route('social.oauth', 'github') }}" class="btn btn-secondary btn-block">
			<i class="fab fa-github mr-2"></i> Github
		</a>
	</div>

</div>

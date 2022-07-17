<?php 

return [
    // Enable register user
    'register' => env('ENABLE_REGISTER', 'true'),

	//If true, it will show the available languages
	'status' => true,

	// Languages
	'languages' => [
		'en'    => ['en', 'en_US', false, 'English', 'us'],
		'es'    => ['es', 'es_ES', false, 'Español', 'es'],
	],
];
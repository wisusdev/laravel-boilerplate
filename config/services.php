<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

	/* Social login */
	// https://developers.facebook.com/
	'facebook' => [
		'client_id'     => env('FACEBOOK_CLIENT_ID'),
		'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
		'redirect'      => '/oauth/facebook/callback',
	],

	// https://developer.twitter.com/en/apps
	'twitter' => [
		'client_id'     => env('TWITTER_CLIENT_ID'),
		'client_secret' => env('TWITETR_CLIENT_SECRET'),
		'redirect'      => '/oauth/twitter/callback',
	],

	// https://console.cloud.google.com/apis/dashboard?pli=1
	'google' => [
		'client_id'     => env('GOOGLE_CLIENT_ID'),
		'client_secret' => env('GOOGLE_CLIENT_SECRET'),
		'redirect'      => '/oauth/google/callback',
	],

	// https://github.com/settings/developers
	'github' => [
		'client_id'     => env('GITHUB_CLIENT_ID'),
		'client_secret' => env('GITHUB_CLIENT_SECRET'),
		'redirect'      => '/oauth/github/callback',
	]

];

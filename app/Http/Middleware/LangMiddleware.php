<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;

class LangMiddleware
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		/*
		 * If esta a true el valor de la variable status que tenemos en envi.php
		 */
		if (config('envi.status')) {
			if (session()->has('locale') && in_array(session()->get('locale'), array_keys(config('envi.languages')))) {

				app()->setLocale(session()->get('locale'));
				setlocale(LC_TIME, config('envi.languages')[session()->get('locale')][1]);
				Carbon::setLocale(config('envi.languages')[session()->get('locale')][0]);

				if (config('envi.languages')[session()->get('locale')][2]) {
					session(['lang-rtl' => true]);
				} else {
					session()->forget('lang-rtl');
				}
			}
		}

		return $next($request);
	}
}

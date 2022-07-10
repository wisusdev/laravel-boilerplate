<?php

namespace App\Http\Controllers\Auth;

use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerificationController extends Controller
{

	/**
	 * Where to redirect users after verification.
	 *
	 * @var string
	 */
	protected string $redirectTo = RouteServiceProvider::HOME;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('signed')->only('verify');
		$this->middleware('throttle:6,1')->only('verify', 'resend');
	}

	public function show(Request $request)
	{
		return $request->user()->hasVerifiedEmail() ? redirect($this->redirectTo) : view('auth.verify');
	}

	public function resend(Request $request)
	{
		$request->user()->sendEmailVerificationNotification();

		return back()->with('info', 'Verification link sent!');
	}

	public function verify(EmailVerificationRequest $request)
	{
		$request->fulfill();

		return redirect($this->redirectTo)->with('success', 'Your email as verify');
	}
}
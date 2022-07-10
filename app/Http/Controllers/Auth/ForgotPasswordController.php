<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Write code on Method
	 *
	 * @return response()
	 */
	public function showLinkRequestForm()
	{
		return view('auth.password.email');
	}

	/**
	 * Write code on Method
	 *
	 * @return response()
	 */
	public function sendResetLinkEmail(Request $request)
	{
		$request->validate([
			'email' => 'required|email|exists:users',
		]);

		$token = Str::random(64);

		DB::table('password_resets')->insert([
			'email' => $request->email,
			'token' => $token,
			'created_at' => Carbon::now()
		]);

		Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
			$message->to($request->email);
			$message->subject('Reset Password');
		});

		return back()->with('info', 'We have e-mailed your password reset link!');
	}
	/**
	 * Write code on Method
	 *
	 * @return response()
	 */
	public function showResetForm($token) {
		return view('auth.password.reset', ['token' => $token]);
	}

	/**
	 * Write code on Method
	 *
	 * @return response()
	 */
	public function reset(Request $request)
	{
		$request->validate([
			'email' => 'required|email|exists:users',
			'password' => 'required|string|min:6|confirmed',
			'password_confirmation' => 'required'
		]);

		$updatePassword = DB::table('password_resets')
			->where([
				'email' => $request->email,
				'token' => $request->token
			])
			->first();

		if(!$updatePassword){
			return back()->withInput()->with('danger', 'Invalid token!');
		}

		$user = User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);

		DB::table('password_resets')->where(['email'=> $request->email])->delete();

		return redirect('/login')->with('success', 'Your password has been changed!');
	}
}
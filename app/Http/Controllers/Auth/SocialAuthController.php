<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * List of providers configured in config/services acts as whitelist
	 *
	 * @var array
	 */
	protected $providers = [
		'github',
		'facebook',
		'google',
		'twitter'
	];

	/**
	 * Redirect to provider for authentication
	 *
	 * @param $driver
	 * @return mixed
	 */
	public function redirectToProvider($driver)
	{
		if (!$this->isProviderAllowed($driver)) {
			return $this->sendFailedResponse("{$driver} is not currently supported");
		}

		try {
			return Socialite::driver($driver)->redirect();
		} catch (Exception $e) {
			return $this->sendFailedResponse($e->getMessage());
		}
	}

	/**
	 * Handle response of authentication redirect callback
	 *
	 * @param $driver
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function handleProviderCallback($driver)
	{
		try {
			$user = Socialite::driver($driver)->user();
		} catch (Exception $e) {
			return $this->sendFailedResponse($e->getMessage());
		}

		// check for email in returned user
		return empty($user->email) ? $this->sendFailedResponse("No email id returned from {$driver} provider.") : $this->loginOrCreateAccount($user, $driver);
	}

	/**
	 * Send a successful response
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	protected function sendSuccessResponse()
	{
		return redirect()->intended('home');
	}

	/**
	 * Send a failed response with a msg
	 *
	 * @param null $msg
	 * @return \Illuminate\Http\RedirectResponse
	 */
	protected function sendFailedResponse($msg = null)
	{
		return redirect()->back()->with('danger', $msg ?: 'Unable to login, try with another provider to login.');
	}

	protected function loginOrCreateAccount($providerUser, $driver)
	{
		try {
			// check for already has account
			$user = User::where('email', $providerUser->getEmail())->first();

			// if user already found
			if ($user) {
				// update the avatar and provider that might have changed
				$user->update([
					'provider' => $driver,
					'provider_id' => $providerUser->id,
					'access_token' => $providerUser->token
				]);
			} else {
				// create a new user
				$user = User::create([
					'name' => $providerUser->getName(),
					'username' => $providerUser->getNickname(),
					'email' => $providerUser->getEmail(),
					'provider' => $driver,
					'provider_id' => $providerUser->getId(),
					'access_token' => $providerUser->token,
					// user can use reset password to create a password
					'password' => ''
				]);

				event(new Registered($user));
			}

			// login the user
			Auth::login($user, true);

			return $this->sendSuccessResponse();
		} catch (\Exception $exception) {
			return redirect()->back()->with('danger', "Error: " . $exception->getMessage());
		}
	}

	/**
	 * Check for provider allowed and services configured
	 *
	 * @param $driver
	 * @return bool
	 */
	private function isProviderAllowed($driver)
	{
		return in_array($driver, $this->providers) && config()->has("services.{$driver}");
	}
}
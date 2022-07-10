<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
	public function __construct()
	{
		$this->middleware('guest', ['only' => ['showLoginForm', 'login', 'showRegistrationForm', 'register']]);
		$this->middleware('auth', ['only' => ['dashboard', 'logout']]);
	}

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	protected string $redirectTo = RouteServiceProvider::HOME;

    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(Request $request){
		try {
			$credentials = $request->validate([
				'email' => ['required', 'email'],
				'password' => ['required'],
			]);

			if (Auth::attempt($credentials)) {
				$request->session()->regenerate();

				return redirect()->intended('home');
			}

			return back()->withErrors(['email' => 'The provided credentials do not match our records.',])->onlyInput('email');

		} catch (\Throwable $th) {
			return redirect()->back()->with('danger', "Error: " . $th->getMessage());
		}
    }

	public function showRegistrationForm(){
        return view('auth.register');
    }

    public function register(Request $request){
        $request->validate([
			'name' => ['required', 'string', 'max:255'],
			'username' => ['required', 'string', 'max:255', 'unique:users'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("home")->with('success', 'You have signed-in');
    }

    public function create(array $data){
        return User::create([
			'name' => $data['name'],
			'username' => $data['username'],
			'email' => $data['email'],
			'password' => Hash::make($data['password']),
        ]);
    }

    public function dashboard() {
        if(Auth::check()){
            return view('backend.home');
        }
  
        return redirect("login")->with('danger', 'You are not allowed to access');
    }

    public function logout() {
        Session::flush();
        Auth::logout();
  
        return redirect('/');
    }
}

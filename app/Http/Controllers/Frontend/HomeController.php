<?php

namespace App\Http\Controllers\Frontend;

class HomeController
{
	public function index(){
		return view('frontend.welcome');
	}

	public function home(){
		return view('backend.home');
	}

	public function swap($lang){
		session()->put('locale', $lang);
		return redirect()->back();
	}
}
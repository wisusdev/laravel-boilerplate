<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
	function __construct(){
        $this->middleware('permission:users.index', ['only' => ['index']]);
        $this->middleware('permission:users.create', ['only' => ['create','store']]);
        $this->middleware('permission:users.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:users.show', ['only' => ['show']]);
        $this->middleware('permission:users.delete', ['only' => ['destroy']]);
    }

	public function index(){
		$users = User::paginate(20);
		return view('backend.users.index', compact('users'));
	}

	public function create(){
		$roles = Role::pluck('name', 'id');
		return view('backend.users.create', compact('roles'));
	}

	public function store(Request $request){
		try {

			$request->validate([
				'name' => 'required|string',
				'username' => 'required|string|unique:users',
				'email' => 'required|email|unique:users',
				'password' => 'required|string|min:8|confirmed',
				'roles' => 'required'
			]);

			$user = User::create([
				'name' => $request->input('name'),
				'username' => $request->input('username'),
				'email' => $request->input('email'),
				'password' => Hash::make($request->input('password')),
			]);

			$roles = $request->input('roles') ? $request->input('roles') : [];
			$user->assignRole($roles);

			return redirect()->route('users.index')->with('success', __('global.successfully_updated'));
		} catch (\Exception $th) {
			return back()->withInput()->withErrors(['danger' => "Error: " . $th->getMessage()]);
		}
	}

	public function show($id){
		$users = User::findOrFail($id);
		return view('backend.users.show', compact('users'));
	}

	public function edit($id){
		$roles = Role::pluck('name', 'id');
		$user = User::findOrFail($id);
		return view('backend.users.edit', compact('user', 'roles'));
	}

	public function update($id, Request $request){
		try {

			$request->validate([
				'name' => 'required|string',
				'username' => 'required|string',
				'email' => 'required|email',
				'roles' => 'required'
			]);

			$user = User::findOrFail($id);
			$user->update($request->all());

			$roles = $request->roles ? $request->roles : [];
			$user->syncRoles($roles);

			return redirect()->route('users.index')->with('success', __('global.successfully_updated'));
		} catch (\Exception $th) {
			return back()->withInput()->withErrors(['danger' => "Error: " . $th->getMessage()]);
		}
	}


	public function destroy($id){
		try {
			$users = User::findOrFail($id);
			$users->delete();
			return redirect()->back()->with('success', __('global.successfully_destroy'));
		} catch (\Throwable $th) {
			return redirect()->back()->with('danger', "Error: " . $th->getMessage());
		}
	}
}

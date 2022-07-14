<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

	public function index(){
		$users = User::paginate(20);
		return view('backend.users.index', compact('users'));
	}


	public function create()
	{
		$roles = Role::pluck('name', 'id');
		return view('backend.users.create', compact('roles'));
	}


	public function store(Request $request)
	{
		try {
			$request->validate([
				'name' => 'required|string',
				'email' => 'required|email',
				'password' => 'required|string|min:8|confirmed',
			]);

			$user = new User;
			$user->name = $request->name;
			$user->email = $request->email;
			$user->password = Hash::make($request->password);
			$user->save();

			$roles = $request->input('roles') ? $request->input('roles') : [];
			$user->assignRole($roles);

			return redirect()->route('users.index')->with('success', __('global.successfully_updated'));
		} catch (\Exception $th) {
			return back()->withInput()->withErrors(['danger' => "Error: " . $th->getMessage()]);
		}
	}

	public function show($id)
	{
		$users = User::findOrFail($id);

		return view('backend.users.show', compact('users'));
	}

	public function edit($id)
	{
		$roles = Role::pluck('name', 'id');
		$users = User::findOrFail($id);
		return view('backend.users.edit', compact('users', 'roles'));
	}

	public function update($id, Request $request)
	{
		try {
			$request->validate([
				'name' => 'required|string',
				'email' => 'required|email',
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
			return response()->json(['status' => 'warning', 'message' => __('global.successfully_destroy')]);
		} catch (\Throwable $th) {
			return redirect()->back()->with('danger', "Error: " . $th->getMessage());
		}
	}
}

<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
	function __construct(){
		$this->middleware('permission:role.index', ['only' => ['index']]);
		$this->middleware('permission:role.create', ['only' => ['create','store']]);
		$this->middleware('permission:role.edit', ['only' => ['edit','update']]);
		$this->middleware('permission:role.show', ['only' => ['show']]);
		$this->middleware('permission:role.delete', ['only' => ['destroy']]);
	}

	public function index(){
		$roles = Role::paginate();
		return view('backend.roles.index', compact('roles'));
	}

	public function create(){
		$permissions = Permission::get()->pluck('name', 'name');
		return view('backend.roles.create', compact('permissions'));
	}

	public function store(Request $request){
		try{
			$role = Role::create($request->except('permission'));
			$permissions = $request->input('permission') ? $request->input('permission') : [];
			$role->givePermissionTo($permissions);

			return redirect()->route('roles.index')->with('success', __('global.successfully_added'));
		} catch (\Throwable $th) {
			return redirect()->back()->with('danger', "Error: " . $th->getMessage());
		}
	}

	public function edit($id){
		$permissions = Permission::get()->pluck('name', 'name');
		$role = Role::findOrFail($id);
		return view('backend.roles.edit', compact('role', 'permissions'));
	}


	public function update(Request $request, $id){
		try{
			$role = Role::findOrFail($id);
			$role->update($request->except('permission'));
			$permissions = $request->input('permission') ? $request->input('permission') : [];
			$role->syncPermissions($permissions);

			return redirect()->route('roles.index')->with('success', __('global.successfully_updated'));
		} catch (\Throwable $th) {
			return redirect()->back()->with('danger', "Error: " . $th->getMessage());
		}
	}

	public function destroy($id){
		$role = Role::findOrFail($id);
		$role->delete();

		return redirect()->route('roles.index')->with('warning', __('global.successfully_destroy'));
	}
}

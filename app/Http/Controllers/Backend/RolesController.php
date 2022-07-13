<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
	public function index(){
		$roles = Role::paginate();
		return view('backend.roles.index', compact('roles'));
	}

	/**
	 * Show the form for creating new Role.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(){
		$permissions = Permission::get()->pluck('name', 'name');
		return view('backend.roles.create', compact('permissions'));
	}

	/**
	 * Store a newly created Role in storage.
	 *
	 * @param  \App\Http\Requests\StoreRolesRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreRolesRequest $request){
		try{
			$role = Role::create($request->except('permission'));
			$permissions = $request->input('permission') ? $request->input('permission') : [];
			$role->givePermissionTo($permissions);

			return redirect()->route('roles.index')->with('success', __('global.successfully_added'));
		} catch (\Throwable $th) {
			return redirect()->back()->with('danger', "Error: " . $th->getMessage());
		}
	}


	/**
	 * Show the form for editing Role.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id){
		$permissions = Permission::get()->pluck('name', 'name');
		$role = Role::findOrFail($id);
		return view('backend.roles.edit', compact('role', 'permissions'));
	}

	/**
	 * Update Role in storage.
	 *
	 * @param  \App\Http\Requests\UpdateRolesRequest  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
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


	/**
	 * Remove Role from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id){
		$role = Role::findOrFail($id);
		$role->delete();

		return redirect()->route('roles.index')->with('warning', __('global.successfully_destroy'));
	}
}

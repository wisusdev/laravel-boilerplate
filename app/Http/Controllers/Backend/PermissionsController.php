<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
	function __construct(){
		$this->middleware('permission:permission.index', ['only' => ['index']]);
		$this->middleware('permission:permission.create', ['only' => ['create','store']]);
		$this->middleware('permission:permission.edit', ['only' => ['edit','update']]);
		$this->middleware('permission:permission.show', ['only' => ['show']]);
		$this->middleware('permission:permission.delete', ['only' => ['destroy']]);
	}

	public function index() {
		$permissions = Permission::get()->pluck('name', 'id');
		return view('backend.permissions.index', compact('permissions'));
	}

	public function create(){
		return view('backend.permissions.create');
	}

	public function store(Request $request){
		Permission::create($request->all());
		return redirect()->route('permissions.index')->with('success', __('global.successfully_added'));
	}

	public function edit($id){
		$permission = Permission::findOrFail($id);
		return view('backend.permissions.edit', compact('permission'));
	}

	public function update(Request $request, $id){
		$permission = Permission::findOrFail($id);
		$permission->update($request->all());
		return redirect()->route('permissions.index')->with('success', __('global.successfully_updated'));
	}

	public function destroy($id){
		$permission = Permission::findOrFail($id);
		$permission->delete();

		return redirect()->route('permissions.index')->with('warning', __('global.successfully_destroy'));
	}
}

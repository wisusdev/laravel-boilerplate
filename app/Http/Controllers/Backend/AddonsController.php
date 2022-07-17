<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Nwidart\Modules\Facades\Module;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Madnest\Madzipper\Facades\Madzipper;

class AddonsController extends Controller
{
	function __construct(){
		$this->middleware('permission:addons.index', ['only' => ['index']]);
		$this->middleware('permission:addons.create', ['only' => ['create','store']]);
		$this->middleware('permission:addons.edit', ['only' => ['edit','update', 'active']]);
		$this->middleware('permission:addons.show', ['only' => ['show']]);
		$this->middleware('permission:addons.delete', ['only' => ['destroy']]);
		$this->middleware('permission:addons.migrate', ['only' => ['migrate']]);
		$this->middleware('permission:addons.download', ['only' => ['download']]);
	}

	public function index(){
		$modules = Module::all();
		return view('backend.addons.index', compact('modules'));
	}

	public function store(Request $request){
		try {
			$zip = Madzipper::make($request->file('addon'));
			$files = collect($zip->listFiles());

			$addon_json = $files->flatten()->filter(function ($file) {
				return Str::endsWith($file, 'module.json');
			})->first();

			$addon_info = json_decode($zip->getFileContent($addon_json));
			$addon_name = $addon_info->name;

			$zip->folder('module/' . $addon_name)->extractTo(base_path('modules/' . $addon_name));
			$zip->folder('assets/' . $addon_name)->extractTo(public_path('content/modules/' . $addon_name));

			return redirect()->route('addons.index')->with('success', __('global.successfully_added_addons', ['module' => $addon_name]));
		} catch (\Exception $e) {
			return redirect()->route('addons.index')->with('danger', "Error: ". $e->getMessage());
		}
	}

	public function destroy($addon_name)
	{
		try {
			File::deleteDirectory(base_path('Modules/' . $addon_name));
			if (file_exists(public_path('content/modules/' . $addon_name))) {
				File::deleteDirectory(public_path('content/modules/' . $addon_name));
			}
			return response()->json(['status' => 'success', 'body' => __('global.successfully_destroy_addons', ['module' => $addon_name])]);
		} catch (\Exception $e) {
			return redirect()->route('addons.index')->with('danger', "Error: " . $e->getMessage());
		}
	}

	public function active(Request $request)
	{
		try {
			$module = Module::find($request->addons_name);

			if($module) {
				$module->isDisabled() ? $module->enable() : $module->disable();
			}

			return redirect()->back()->with('success', __('global.successfully_active_addons', ['module' => $request->addons_name]));
		} catch (\Exception $e) {
			return redirect()->back()->with('danger', "Error: ". $e->getMessage());
		}
	}

	public function migrate($addon){
		Artisan::call('migrate');

		return redirect()->back()->with('success', __('global.successfully_updated'));
	}

	public function download($addon){
		try{
			$module = base_path() . '/modules/' . $addon;
			$assets = public_path() . '/content/modules/' . $addon;

			if (!file_exists($assets)){
				mkdir($assets, 0775, true);
			}

			Madzipper::make($addon . '.zip')->folder('module/' . $addon)->add($module)->folder('assets/' . $addon)->add($assets)->close();

			return response()->download(public_path($addon .'.zip'))->deleteFileAfterSend(true);
		} catch (\Exception $e) {
			return redirect()->route('addons.index')->with('danger', "Error: " . $e->getMessage());
		}
	}


}

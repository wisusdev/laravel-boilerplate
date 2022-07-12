<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use anlutro\LaravelSettings\Facades\Setting;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    public function index(){
        $settings = Setting::all();
        return view('backend.settings.index', compact('settings'));
    }

    public function store(Request $request){

        if(setting('logo')){
           File::delete(public_path() . setting('logo'));
        }

        $logo = $request->file('site_logo');
        $destinationPath = 'uploads/' . date('Y') . '/' . date('m') . '/' . date('d');
        
        $filename = $logo->getClientOriginalName();
        $logo->storeAs($destinationPath, $filename, 'public');
        
        $logo_path = '/storage/' . $destinationPath . '/' . $filename;
        
        setting([
            'google_analytics' => $request->input('google_analytics'),
            'site_description' => $request->input('site_description'),
            'logo' => $logo_path,
        ])->save();

        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;

class EnvController extends Controller
{
	public function index(){
		$keys = DotenvEditor::getKeys();
		return view('backend.env.index', compact('keys'));
	}

	public function edit($id){
		$key = DotenvEditor::getKey($id);
		return response()->json(['status' => 'success', 'body' => ['key' => $id, 'value' => $key]]);
	}

	public function update(Request $request){
		DotenvEditor::setKey($request->key, $request->value)->save();
		return response()->json(['status' => 'success', 'body' => ['key' => $request->key, 'value' => $request->value]]);
	}
}

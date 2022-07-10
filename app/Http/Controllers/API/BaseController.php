<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;


class BaseController extends Controller
{

	public function handleResponse($result, $msg)
	{
		$res = [
			'success' => true,
			'data'    => $result,
			'message' => $msg,
		];
		return response()->json($res, 200);
	}

	public function handleError($error, $errorMsg = [], $code = 404)
	{
		$res = [
			'success' => false,
			'message' => $error,
		];
		if(!empty($errorMsg)){
			$res['data'] = $errorMsg;
		}
		return response()->json($res, $code);
	}
}
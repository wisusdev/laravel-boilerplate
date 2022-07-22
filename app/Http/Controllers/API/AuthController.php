<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;


class AuthController extends BaseController
{

	public function login(Request $request){
        //valida las credenciales del usuario
        if (!Auth::attempt($request->only('email', 'password'))){
			return $this->handleError('Unauthorised.', ['error'=>'Unauthorised'], 401);
        }

        //Busca al usuario en la base de datos
        $user = User::where('email', $request['email'])->firstOrFail();

        //Genera un nuevo token para el usuario
        $token = $user->createToken('auth_token')->plainTextToken;

        //devuelve una respuesta JSON con el token generado y el tipo de token
        $data = [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ];

		return $this->handleResponse($data, 'User logged-in!');
    }

	public function register(Request $request){

        //se valida la información que viene en $request
		$validatedData = Validator::make($request->all(), [
			'name' => ['required', 'string', 'max:255'],
			'username' => ['required', 'string', 'max:255', 'unique:users'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			'password' => ['required', 'string', 'min:8', 'confirmed'],
		]);

		if($validatedData->fails()){
			return $this->handleError($validatedData->errors());
		}

        //se crea el usuario en la base de datos
        $user = User::create([
            'name' => $request->name,
			'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        //se crea token de acceso personal para el usuario
        $token = $user->createToken('auth_token')->plainTextToken;

        //se devuelve una respuesta JSON con el token generado y el tipo de token
        $success = [
            'access_token' => $token,
            'token_type' => 'Bearer'
        ];

		return $this->handleResponse($success, 'User successfully registered!');
    }

	public function logout(Request $request){
		$request->user()->tokens()->delete();
		return response()->json(['message' => 'success'], 200);
    }

}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profile;
use App\Http\ProfileResource;
use App\Http\Requests\StoreUserRequest;


class UserController extends Controller
{

    //Crear un nuevo usuario
    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);

        return  response()->json([
            'messaje'=>'Usuario creado correctamente',
            'user'=>$user,
            'token' => $user->createToken('api_token')->plainTextToken,
            'type'=>'bearer',
        ],201);
    }

    //Iniciar sesion
    public function login(Request $request){

        $credenciales=$request->only('email','password');

        if (!Auth::attempt($credenciales)) {
            return response()->json(['error'=>'Error en el usuario o la contraseña'],401);
        }

        return  response()->json([
            'message'=>'Sesion iniciada correctamente',
            'user'=>Auth::user(),
            'token' =>Auth::user()->createToken('api_token')->plainTextToken,
            'type'=>'bearer',
        ],200);
    }


    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->json([
            'message'=>'Sesion cerrada',
        ], 200);
    }

}

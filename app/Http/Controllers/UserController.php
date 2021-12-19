<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profile;
use App\Http\ProfileResource;


class UserController extends Controller
{

    public function index()
    {

    }

    //Crear un nuevo usuario
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'password' => bcrypt($request['password']),
            'email' => $request['email'],
        ]);

        return  response()->json([
            'mensaje'=>'Usuario creado correctamente',
            'token' => $user->createToken('api_token')->plainTextToken,
            'type'=>'bearer',
        ],201);
    }

    //Iniciar sesion
    public function login(Request $request){

        $credenciales=$request->only('email','password');

        if (!Auth::attempt($credenciales)) {
            return  response()->json(['message'=>'Error en su usuario y contraseña, intentelo nuevamente'],401);
        }

        return  response()->json([
            'message'=>'Sesion iniciada correctamente',
            'token' => Auth::user()->createToken('api_token')->plainTextToken,
            'type'=>'bearer',
        ],200);
    }

}

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
        try
        {
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
            ]);

            return  response()->json([
                'success'=>true,
                'message'=>'Se creo el usuario',
                'data'=>[
                    'token'=>$user->createToken('api_token')->plainTextToken,
                    'type'=>'bearer',
                ]
            ],201);

        }
        catch(\Exception $exception)
        {
            return response()->json([
                'success'=>false,
                'message'=>'Error en la conexion',
            ], 500);
        }
    }

    //Iniciar sesion
    public function login(Request $request)
    {
        try
        {
            $credenciales=$request->only('email','password');

            if (!Auth::attempt($credenciales)) 
            {
                return response()->json([
                    'success'=>false,
                    'message'=>'Error de credenciales',
                ],401);
            }
            Auth::user()->tokens()->delete();    
            
            return  response()->json([
                'success'=>true,
                'message'=>'Inicio de sesion exitoso',
                'data'=>[
                    'token'=>Auth::user()->createToken('api_token')->plainTextToken,
                    'type'=>'bearer',
                ]
            ],201);
        }
        catch(\Exception $exception)
        {
            return response()->json([
                'success'=>false,
                'message'=>'Error en la conexion',
            ],500);
        }        
    }

    //Cerrar sesion
    public function logout()
    {
        try
        {
            Auth::user()->tokens()->delete();
            return response()->json([
                'success'=>true,
                'message'=>'Sesion cerrada',
            ], 200);
        }
        catch(\Exception $exception){
            return response()->json([
                'success'=>false,
                'message'=>'Error en la conexion',
            ], 500);
        }
    }

}

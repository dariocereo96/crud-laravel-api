<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Resources\ProfileResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    //Crear un nuevo usuario
    public function register(StoreUserRequest $request)
    {
        return DB::transaction(function ()use ($request) {
            try
            {
                $user = User::create([
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                ]);
                $user->profile()->create([
                    'name'=>$request->name,
                    'lastname'=>$request->lastname,
                    'photo'=>$request->hasfile('photo')?$request->file('photo')->store('profile','public'):"notFound",
                ]);
                return  response()->json([
                    'token'=>$user->createToken('api_token')->plainTextToken,
                    'type'=>'bearer',
                    'profile'=>ProfileResource::make($user->profile),
                ],201);
            }
            catch(\Exception $exception)
            {
                return response()->json([
                    'errors'=>[
                        'info'=>'Ocurrio un problema en la aplicacion',
                    ],
                ],500);
            }
        },5);
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
                    'errors'=>[
                        'info'=>'Error en las credenciales',
                    ],
                ],400);
            }
            return  response()->json([
                    'token'=>Auth::user()->createToken('api_token')->plainTextToken,
                    'type'=>'bearer',
		            'profile'=>ProfileResource::make(Auth::user()->profile),
            ],200);
        }
        catch(\Exception $exception)
        {
            return response()->json([
                'errors'=>[
                    'info'=>'Ocurrio un problema en la aplicacion',
                ]
            ],500);
        }        
    }

    //Cerrar sesion
    public function logout()
    {
        try
        {
            Auth::user()->tokens()->where('id',currentAccessToken())->delete();
            return response()->json([
                'message'=>'Sesion cerrada',
            ], 200);
        }
        catch(\Exception $exception)
        {
            return response()->json([
                'errors'=>[
                    'info'=>'Ocurrio un problema en la aplicacion',
                ],
            ],500);
        }
    }


}

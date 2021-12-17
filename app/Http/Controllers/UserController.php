<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return UserResource::collection(User::paginate(7));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json(UserResource::make($user),200);
    }


    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'password' => bcrypt($request['password']),
            'email' => $request['email']
        ]);

        return  response()->json([
            "mensaje"=>"Usuario creado correctamente",
            'token' => $user->createToken('API Token')->plainTextToken,
            "type"=>"bearer"
        ],201);
    }

    //iniciar sesion
    public function login(Request $request){
        $credenciales=$request->only("email","password");

        if (!Auth::attempt($credenciales)) {
            return  response()->json(["mensaje"=>"error en el usuario y la contaseña"],401);
        }

        return  response()->json([
            "message"=>"Sesion iniciada correctamente",
            'token' => Auth::user()->createToken('API Token')->plainTextToken,
            "type"=>"bearer"
        ],201);
    }
}

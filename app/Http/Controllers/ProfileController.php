<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\ArticleResource;

class ProfileController extends Controller
{
    //Mostrar los perfiles del blog
    public function index()
    {
       return ProfileResource::collection(Profile::paginate(10));
    }

    //Obtener un perfil del blog
    public function show(Profile $profile)
    {
        return ProfileResource::make($profile);
    }

    //Mostrar articulos del perfil
    public function articles(Profile $profile)
    {
        $articles=$profile->user->articles()->paginate(10);
        return ArticleResource::collection($articles);
    }
}

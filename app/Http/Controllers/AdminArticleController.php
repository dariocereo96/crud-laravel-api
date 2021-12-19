<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class AdminArticleController extends Controller
{
    //Mostrar los articulos del usuario
    public function index()
    {
        $articles=Auth::user()->articles()->paginate(10);
        return ArticleResource::collection($articles);
    }

    //Crear un articulo
    public function store(Request $request){
        $article=Auth::user()->articles()->create($request->all());
        return response()->json([
            'message'=>'Articulo creado correctamente',
            'data'=>$article,
        ], 201);

    }

    public function update(Request $request,Article $article)
    {
        $article->update($request->all());
        return response()->json([
            'message'=>'Articulo actualizado',
            'data'=>$request->all(),
        ], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\UserResource;
use App\Http\Resources\CommentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ArticleController extends Controller
{

    //Mostrar los articulos del blog
    public function index()
    {
        try
        {
            $articles=ArticleCollection::make(Article::paginate(7));
            return $articles;
        }
        catch(\Exception $exception)
        {
            return response()->json([
                'status'=>'error',
                'message'=>'Error en la conexion a la Base de Datos',
            ], 500);
        }
    }

    public function store(StoreArticleRequest $request)
    {
        return $request->file("image")->store("public/imagenes");
    }

    //Obtener un articulo del blog
    public function show(Article $article)
    {
        return ArticleResource::make($article);
    }


    public function update(UpdateArticleRequest $request)
    {
        return response()->json($request['id'], 200);
    }

    //Mostrar comentarios del articulo
    public function comments(Article $article)
    {
        $comments=$article->comments()->paginate(10);
        return CommentResource::collection($comments);
    }
}

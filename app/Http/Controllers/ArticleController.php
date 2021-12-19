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
       return ArticleResource::collection(Article::paginate(10));
    }

    public function store(StoreArticleRequest $request)
    {
       /*  $articulo=Article::create($request->all());
        return response()->json($articulo, 201); */

        return $request->file("image")->store("public/imagenes");
    }

    //Obtener un articulo del blog
    public function show(Article $article)
    {
        return ArticleResource::make($article);
    }


    public function update(UpdateArticleRequest $request)
    {
        //
        return response()->json($request['id'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return response()->json(null, 404);
    }

    //Mostrar comentarios del articulo
    public function comments(Article $article)
    {
        $comments=$article->comments()->paginate(10);
        return CommentResource::collection($comments);
    }
}

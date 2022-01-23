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
            $articles=ArticleCollection::make(Article::paginate(10));
            return $articles;
        }
        catch(\Exception $exception)
        {
            return response()->json([
                'success'=>false,
                'message'=>'Ocurrio un problema',
                'errors'=>[
                    'info'=>'Error en el sistema',
                ],
            ],500);
        }
    }

    //Obtener un articulo del blog
    public function show($id)
    {
        try
        {
            $article=Article::find($id);
            if($article==null){
                return response()->json([
                    'success'=>false,
                    'message'=>'Ocurrio un problema',
                    'errors'=>[
                        'info'=>'No se encontro articulo',
                    ],
                ],404);
            }
            return response()->json([
                'success'=>true,
                'message'=>'Articulo encontrado',
                'data'=>ArticleResource::make($article),
            ], 200);
           
        }
        catch(\Exception $exception)
        {
            return response()->json([
                'success'=>false,
                'message'=>'Ocurrio un problema',
                'errors'=>[
                    'info'=>'Error en el sistema',
                ],
            ],500);
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;

class AdminArticleController extends Controller
{
    //Mostrar los articulos del usuario
    public function index(){
        try
        {
            $articles=Auth::user()->articles()->paginate(10);

            if($articles==null){
                return response()->json([
                    'success'=>false,
                    'message'=>'Ocurrio un problema',
                    'errors'=>[
                        'info'=>'No se encontraron articulos',
                    ],
                ],404);
            }
            return ArticleCollection::make($articles);
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

    //Crear un articulo
    public function store(StoreArticleRequest $request){
        try
        {
            $article=Auth::user()->articles()->create($request->all());
                return response()->json([
                'success'=>true,
                'message'=>'Articulo creado correctamente',
                'data'=>$article,
            ], 201);
        }
        catch(\Exception $exception){
            return response()->json([
                'success'=>false,
                'message'=>'Ocurrio un problema',
                'errors'=>[
                    'info'=>'Error en el sistema',
                ],
            ],500);
        }
    }

     //Obtener un articulo del usuario
     public function show($id){
        try
        {
            $article=Auth::user()->articles()->find($id);
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
                'success'=>false,
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

    //Actualizar articulo del usuario
    public function update(UpdateArticleRequest $request,$id){
        try
        {
            $article=Auth::user()->articles()->find($id);
            if($article==null){
                return response()->json([
                    'success'=>false,
                    'message'=>'Ocurrio un problema',
                    'errors'=>[
                        'info'=>'No se encontro el articulo',
                    ],
                ],404);
            }
            $article->update($request->all());
            return response()->json([
                'success'=>true,
                'message'=>'Articulo actualizado',
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

    //Eliminar articulo del usuario
    public function destroy($id){
        try
        {
            $article=Auth::user()->articles()->find($id);
            if($article==null){
                return response()->json([
                    'success'=>false,
                    'message'=>'Ocurrio un problema',
                    'errors'=>[
                        'info'=>'No se encontro articulo',
                    ],
                ],404);
            }
            $article->delete();
            return response()->json([
                'success'=>true,
                'message'=>'Articulo eliminado',
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

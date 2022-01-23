<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CommentResource;
use App\Http\Resources\CommentCollection;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

class CommentController extends Controller
{
    //Mostrar los comentarios del articulo
    public function index($id)
    { 
        try
        {
            $comments=Article::find($id)->comments()->paginate(10);
            if($comments==null){
                return response()->json([
                    'success'=>false,
                    'message'=>'Ocurrio un problema',
                    'errors'=>[
                        'info'=>'Error en el sistema',
                    ],
                ],404);
            }
            return CommentCollection::make($comments);
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

    //Actualizar comentario
    public function update(UpdateCommentRequest $request,$id){
        try
        {
            $comment=Comment::find($id);

            if($comment==null){
                return response()->json([
                    'success'=>false,
                    'message'=>'Ocurrio un problema',
                    'errors'=>[
                        'info'=>'No se encontro el comentario',
                    ],
                ],404);
            }

            if($comment->user->id!=Auth::user()->id){
                return response()->json([
                    'success'=>false,
                    'message'=>'Ocurrio un problema',
                    'errors'=>[
                        'info'=>'Prohibido al accesso',
                    ],
                ],403);
            }
            $comment->update($request->all());
            return response()->json([
                'success'=>true,
                'message'=>'Comentario actualizado',
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

    //Crear un comentario para el articulo
    public function store(StoreCommentRequest $request,$id)
    {
        try
        {
            $article=Article::find($id);

            if($article==null)
            {
                return response()->json([
                    'success'=>false,
                    'message'=>'Ocurrio un problema',
                    'errors'=>[
                        'info'=>'No se encontro el articulo',
                    ],
                ],404);
            }
            $comment=new Comment($request->all());
            $comment->user_id=Auth::user()->id;

            $article->comments()->save($comment);

            return response()->json([
                'success'=>true,
                'message'=>'Se creo el comentario',
                'data'=>CommentResource::make($comment),
            ], 201);
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

    //Eliminar comentario 
    public function destroy($id)
    {
        $comment=Comment::find($id);

        if($comment==null){
            return response()->json([
                'success'=>false,
                'message'=>'Ocurrio un problema',
                'errors'=>[
                    'info'=>'No se encontro el comentario',
                ],
            ],404);
        }

        if($comment->user->id!=Auth::user()->id){
            return response()->json([
                'success'=>false,
                'message'=>'Ocurrio un problema',
                'errors'=>[
                    'info'=>'Prohibido al accesso',
                ],
            ],402);
        }
        $comment->delete();
        return response()->json([
                'success'=>true,
                'message'=>'Articulo eliminado',
                ], 200);
    }
}

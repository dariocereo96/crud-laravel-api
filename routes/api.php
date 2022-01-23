<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminArticleController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Iniciar sesion
Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login');

//Crear nuevo usuario
Route::post('auth/register', [AuthController::class, 'register'])->name('auth.register');

//Obtener todos los articulos del blog
Route::get('articles', [ArticleController::class, 'index'])->name('articles.index');

//Obtener un articulo
Route::get('articles/{id}', [ArticleController::class, 'show'])->name('articles.show');

//Obtener los comentarios del article
Route::get('articles/{id}/comments', [CommentController::class, 'index'])->name('comments.index');


//Rutas con autentificacion
Route::middleware('auth:sanctum')->group(function () {

    //---------------------------------------------------------------------------------------------------------
    //Mostrar los articulos del usuario
    Route::get('admin/articles', [AdminArticleController::class, 'index'])->name('admin.articles.index');

    //Obtener un articulo del usuario
    Route::get('admin/articles/{id}', [AdminArticleController::class, 'show'])->name('admin.articles.show');

    //Crear un nuevo articulo
    Route::post('admin/articles', [AdminArticleController::class, 'store'])->name('admin.articles.store');

    //Editar un articulo
    Route::put('admin/articles/{id}', [AdminArticleController::class, 'update'])->name('admin.articles.update');

    //Eliminar un articulo
    Route::delete('admin/articles/{id}', [AdminArticleController::class, 'destroy'])->name('admin.articles.destroy');


    //------------------------------------------------------------------------------------------------------------
    //Comentar un articulo
    Route::post('articles/{id}/comments', [CommentController::class, 'store'])->name('comments.store');

    //Eliminar comentario
    Route::delete('comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');

    //Editar un comentario
    Route::put('comments/{id}', [CommentController::class, 'update'])->name('comments.update');

    //Cerrar sesion
    Route::post('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');




});





//     // //Obtener perfil del usuario
//     //// Route::get('admin/profiles', [AdminProfileController::class, 'show'])->name('admin.profile.show');

// //     // //Crear perfil del usuario
// //     // Route::post('profile', [ProfileController::class, 'store'])->name('admin.profile.store');

// //     // //Editar el perfil del usuario
// //     // Route::put('profile', [ProfileController::class, 'update'])->name('admin.profile.update');

  








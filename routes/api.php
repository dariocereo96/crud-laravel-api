<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;


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
Route::post('login', [UserController::class, 'login'])->name('login');

//Crear nuevo usuario
Route::post('register', [UserController::class, 'register'])->name('register');

//Cerrar sesion
Route::post('logout', [UserController::class, 'logout'])->name('logout');

//Obtener todos los articulos del blog
Route::get('articles', [ArticleController::class, 'index'])->name('articles.index');

//Obtener un articulo especifico
Route::get('articles/{id}', [ArticleController::class, 'show'])->name('articles.show');

//Obtener los comentarios del articulo
Route::get('articles/{id}/comments', [CommentController::class, 'index'])->name('comments.index');


Route::middleware(['auth', 'sanctum'])->group(function () {

    //Crear un articulo
    Route::post('articles', [ArticleController::class, 'store'])->name('articles.store');

    //Editar un articulo
    Route::put('articles', [ArticleController::class, 'update'])->name('articles.update');

    //Eliminar un articulo
    Route::delete('articles/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');

    //Crear un comentario al articulo
    Route::post('articles/{id}/comments', [CommentController::class, 'store'])->name('comments.store');

    //Obtener un comentario especifico
    Route::get('comments/{id}', [CommentController::class, 'show'])->name('comments.show');

    //Editar un comentario
    Route::put('comments/{id}', [CommentController::class, 'update'])->name('comments.update');

    //Eliminar un comentario
    Route::delete('comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');

    //Obtener perfil del usuario
    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');

    //Editar el perfil del usuario
    Route::put('profile', [CommentController::class, 'update'])->name('comments.update');



});











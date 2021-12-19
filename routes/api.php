<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminArticleController;

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

//Obtener todos los articulos del blog
Route::get('articles', [ArticleController::class, 'index'])->name('articles.index');

//Obtener un articulo
Route::get('articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

//Obtener los comentarios del articulo
Route::get('articles/{article}/comments', [ArticleController::class, 'comments'])->name('articles.comments');

//Obtener perfiles del blog
Route::get('profiles/', [ProfileController::class, 'index'])->name('index');

//Obtener un perfil del blog
Route::get('profiles/{profile}', [ProfileController::class, 'show'])->name('show');

//obtener los articulos de un perfil
Route::get('profiles/{profile}/articles', [ProfileController::class, 'articles'])->name('profiles.show');

//Rutas protegidas
Route::middleware('auth:sanctum')->group(function () {

    //Mostrar los articulos creado por el usuario
    Route::get('admin/articles', [AdminArticleController::class, 'index'])->name('admin.articles.index');

    //Crear un nuevo articulo
    Route::post('admin/articles', [AdminArticleController::class, 'store'])->name('admin.articles.store');

    //Editar un articulo del usuario
    Route::put('admin/articles/{article}', [AdminArticleController::class, 'update'])->name('admin.articles.update');

//     // //Eliminar un articulo del usuario
//     // Route::delete('articles/{id}', [AdminArticleController::class, 'destroy'])->name('admin.articles.destroy');

//     // //Obtener perfil del usuario
//     // Route::get('profile', [ProfileController::class, 'show'])->name('admin.profile.show');

//     // //Crear perfil del usuario
//     // Route::post('profile', [ProfileController::class, 'store'])->name('admin.profile.store');

//     // //Editar el perfil del usuario
//     // Route::put('profile', [ProfileController::class, 'update'])->name('admin.profile.update');

//     // //Cerrar sesion
//     // Route::post('logout', [UserController::class, 'logout'])->name('logout');


});








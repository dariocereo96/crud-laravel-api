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
Route::post('users/login', [UserController::class, 'login'])->name('users.login');

//Crear nuevo usuario
Route::post('users', [UserController::class, 'store'])->name('users.store');

// Obtener todos los articulos del blog
Route::get('articles', [ArticleController::class, 'index'])->name('articles.index')->middleware('auth:sanctum');

// //Obtener un articulo
// //Route::get('articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

// //Obtener los comentarios del articulo
//// Route::get('articles/{article}/comments', [ArticleController::class, 'comments'])->name('articles.comments');

// //Obtener perfiles del blog
//// Route::get('profiles/', [ProfileController::class, 'index'])->name('index');

// //Obtener un perfil del blog
// //Route::get('profiles/{profile}', [ProfileController::class, 'show'])->name('show');

// //obtener los articulos de un perfil
// //Route::get('profiles/{profile}/articles', [ProfileController::class, 'articles'])->name('profiles.show');


// //Rutas con autentificacion
// Route::middleware('auth:sanctum')->group(function () {

//     //Mostrar los articulos creados
//     Route::get('admin/articles', [AdminArticleController::class, 'index'])->name('admin.articles.index');

//     //Obtener un articulo
//     Route::get('admin/articles/{article}', [AdminArticleController::class, 'show'])->name('admin.articles.show');

//     //Crear un nuevo articulo
//     Route::post('admin/articles', [AdminArticleController::class, 'store'])->name('admin.articles.store');

//     //Editar un articulo
//     Route::put('admin/articles/{article}', [AdminArticleController::class, 'update'])->name('admin.articles.update');

//     //Eliminar un articulo
//     Route::delete('admin/articles/{id}', [AdminArticleController::class, 'destroy'])->name('admin.articles.destroy');

//     // //Obtener perfil del usuario
//     //// Route::get('admin/profiles', [AdminProfileController::class, 'show'])->name('admin.profile.show');

// //     // //Crear perfil del usuario
// //     // Route::post('profile', [ProfileController::class, 'store'])->name('admin.profile.store');

// //     // //Editar el perfil del usuario
// //     // Route::put('profile', [ProfileController::class, 'update'])->name('admin.profile.update');

    //Cerrar sesion
    Route::post('users/logout', [UserController::class, 'logout'])->name('users.logout')->middleware('auth:sanctum');

// });








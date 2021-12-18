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


/****************************************** Rutas Autentificacion *******************************************************/

Route::post('login', [UserController::class, 'login'])->name('login');

Route::post('register', [UserController::class, 'register'])->name('register');

Route::get('user', [UserController::class, 'show'])->name('user.show')->middleware(['auth:sanctum']);

/*************************************** Rutas al recurso article *******************************************************/

Route::get('articles', [ArticleController::class, 'index'])->name('articles.index');

Route::get('articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

Route::post('articles', [ArticleController::class, 'store'])->name('articles.store');

Route::put('articles/{id}', [ArticleController::class, 'update'])->name('articles.update');

Route::delete('articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');

Route::post('articles/{article}/comments', [ArticleController::class, 'store_comments'])->name('articles.store_comments');

Route::get('articles/{article}/comments', [ArticleController::class, 'show_comments'])->name('articles.show_comments');




//Rutas al recurso comments




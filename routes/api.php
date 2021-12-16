<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Rutas al recurso Article
Route::get('article', [ArticleController::class, 'index'])->name('article.index');
Route::get('article/{article}', [ArticleController::class, 'show'])->name('article.show');
Route::post('article', [ArticleController::class, 'store'])->name('article.store');
Route::put('article/{article}', [ArticleController::class, 'update'])->name('article.update');
Route::delete('article/{article}', [ArticleController::class, 'destroy'])->name('article.destroy');




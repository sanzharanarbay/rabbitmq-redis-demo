<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticleController;

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

Route::get('/articles/all', [ArticleController::class, 'index']);
Route::post('/articles/create', [ArticleController::class, 'store']);
Route::post('/articles/queue', [ArticleController::class, 'queue']);
Route::get('/articles/redis', [ArticleController::class, 'redis']);

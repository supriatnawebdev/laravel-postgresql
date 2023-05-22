<?php

use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthenticationController;

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



Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [AuthenticationController::class, 'logout']);
    Route::get('/login/detail', [AuthenticationController::class, 'checkLoginStatus']);  

    // post controller
    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/posts/{id}', [PostController::class, 'show']);
    Route::patch('/posts/{id}', [PostController::class, 'update'])->middleware(['pemilikpostingan']);
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->middleware(['pemilikpostingan']);
    Route::post('/posts', [PostController::class, 'store']);

    Route::post('/comment', [CommentController::class, 'store']);
    Route::patch('/comment/{id}', [CommentController::class, 'update'])->middleware(['pemilikcomment']);
    Route::delete('/comment/{id}', [CommentController::class, 'destroy'])->middleware(['pemilikcomment']);


});
Route::post('/login',  [AuthenticationController::class, 'loginUser']);
Route::post('/register',  [AuthenticationController::class, 'createUser']);



// Route::get('/posts/{id}', [PostController::class, 'show']);
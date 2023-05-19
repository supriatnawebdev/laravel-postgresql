<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

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
});
Route::post('/login',  [AuthenticationController::class, 'loginUser']);
Route::post('/register',  [AuthenticationController::class, 'createUser']);

Route::get('/posts', [PostController::class, 'index'])->middleware(['auth:sanctum']);
Route::get('/posts/{id}', [PostController::class, 'show'])->middleware(['auth:sanctum']);
Route::patch('/posts/{id}', [PostController::class, 'update'])->middleware(['auth:sanctum', 'pemilikpostingan']);
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->middleware(['auth:sanctum', 'pemilikpostingan']);
Route::post('/posts', [PostController::class, 'store'])->middleware(['auth:sanctum']);

// Route::get('/posts/{id}', [PostController::class, 'show']);
<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register',[UserController::class,'register']);
Route::post('login',[UserController::class,'login']);
Route::get('posts', [PostController::class,'index']);
Route::post('/posts', [PostController::class,'store']);
Route::get('posts/{id}', [PostController::class,'show']);
Route::delete('posts/{id}', [PostController::class,'destroy']);
Route::put('posts/{id}', [PostController::class,'update']);

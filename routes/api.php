<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;
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

Route::group(['middleware' => 'auth:sanctum'],function (){
    Route::post('/category/create',[CategoryController::class,'store']);
    Route::post('/category/delete',[CategoryController::class,'destroy']);
    Route::get('/category',[CategoryController::class,'list']);
    Route::get('/category/{id}',[CategoryController::class,'show']);

    Route::get('/book',[BookController::class,'list']);
    Route::post('/book/create',[BookController::class,'store']);
    Route::post('/book/delete',[BookController::class,'destroy']);
    Route::get('/book/{id}',[BookController::class,'show']);
    Route::get('/user/logout',[AuthController::class,'logout']);

});

Route::post('/user/login',[AuthController::class,'login']);



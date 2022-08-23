<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
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

Route::post('/category/create',[CategoryController::class,'create'])->middleware('checkHeader');
Route::post('/category/delete',[CategoryController::class,'destroy'])->middleware('checkHeader');
Route::get('/category',[CategoryController::class,'list'])->middleware('checkHeader');
Route::get('/category/{id}',[CategoryController::class,'show'])->middleware('checkHeader');

Route::post('/book/create',[BookController::class,'store'])->middleware('checkHeader');
Route::get('/books',[BookController::class,'index'])->middleware('checkHeader');
Route::post('/book/delete',[BookController::class,'destroy'])->middleware('checkHeader');
Route::get('/book/{id}',[BookController::class,'show'])->middleware('checkHeader');

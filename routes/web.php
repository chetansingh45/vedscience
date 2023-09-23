<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\SliderController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
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

    Route::get('/slider',[SliderController::class,'index']);
    Route::get('/slider/{slider}',[SliderController::class,'show']);

});

Route::post('/user/login',[AuthController::class,'login']);
Route::get('/user/logout',[AuthController::class,'logout']);

Route::get('/abc',function(Request $request){
    return "a";
})->middleware('auth:sanctum');




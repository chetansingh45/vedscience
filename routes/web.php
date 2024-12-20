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

Route::get('/category',[CategoryController::class,'list']);
Route::get('/category/{id}',[CategoryController::class,'show']);

Route::get('/slider',[SliderController::class,'index']);
Route::get('/slider/{slider}',[SliderController::class,'show']);

Route::get('/book/{id}',[BookController::class,'show']);
Route::get('/book',[BookController::class,'list']);





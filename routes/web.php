<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::post('/login',[AuthController::class,'login'])->middleware('guest');
Route::post('/register',[AuthController::class,'register'])->middleware('guest');

Route::group(['middleware' => ['auth:sanctum']],function (){
    Route::get('/my',[AuthController::class,'me']);
    Route::post('/logout',[AuthController::class,'logout']);
    Route::put('todos/{todo}/change-status', [TodoController::class,'changeStatus']);
    Route::apiResource('todos', TodoController::class);
});






Route::view('/{any}', 'index')->where('any','.*');

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'v1'],function (){

});

// Route::group(['middleware' => ['auth:sanctum']],function (){

//     Route::put('todos/{todo}/change-status', [TodoController::class,'changeStatus']);
//     Route::apiResource('todos', TodoController::class);
// });







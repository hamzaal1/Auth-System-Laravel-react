<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TasksController;
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



Route::controller(AuthController::class)->group(function () {
    Route::post('/login','login');
    Route::post('/register','register');
});

Route::group(['middleware'=>'auth:sanctum'],function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::controller(TasksController::class)->group(function () {
        Route::get('/task','index');
        Route::get('/task/{task}','show');
        Route::post('/task','store');
        // Route::post('/','register');
    });
    
    Route::group([
        'prefix'=>'admin',
        'middleware'=>['auth:sanctum','admin'],
        'as'=>'admin.'
    ],function () {
        // Admin Tasks 
        //  Route::post('/tasks',[TasksController::class,'register']);

    });
});
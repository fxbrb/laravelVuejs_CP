<?php

use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\UserController;
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
    Route::post('login', 'login');
    Route::post('register', 'register');
});


Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::controller(AboutController::class)->group(function () {
        Route::get('about', 'index');
        Route::post('edit/about/{id}', 'update_about');
    });

    Route::controller(ProjectController::class)->group(function () {
        Route::get('/projects', 'index');
        Route::get('/project/edit/{id}', 'get_edit_project');
        Route::post('/project/new', 'new_project');
        Route::put('/project/update/{id}', 'update_project');
        Route::delete('/project/delete/{id}', 'delete_project');
    });

    Route::controller(MessageController::class)->group(function () {
        Route::get('/messages', 'get_messages');
        Route::post('/messages/update_status/{id}', 'update_status');
        Route::delete('/messages/delete/{id}', 'delete_message');
    });


});



Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'get_users');
});
<?php

use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('posts', [PostController::class,'index']);

Route::group(['prefix' => 'post'], function () {
    Route::post('add', [PostController::class,'add']);
    Route::get('edit/{id}', [PostController::class,'edit']);
    Route::post('update/{id}', [PostController::class,'update']);
    Route::delete('delete/{id}', [PostController::class,'delete']);
});

Route::controller(AuthController::class)->group(function () {
    Route::get('user', 'user');
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::get('me', 'me');
    Route::post('refresh', 'refresh');
});



Route::group(['middleware' => ['auth:api','role:SUPER_ADMIN']], function () {
    Route::get('admins', [AdminController::class,'index']);
    Route::post('admins', [AdminController::class,'create']);
    Route::put('admins/{id}', [AdminController::class,'update']);
});

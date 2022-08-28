<?php

use App\Http\Controllers\API\AccountController;
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
    Route::get('admins', [AccountController::class,'index'])->name('admins.index');
    Route::get('admins/{id}', [AccountController::class,'edit'])->name('admins.edit');
    Route::post('admins', [AccountController::class,'create'])->name('admins.create');
    Route::put('admins/{id}', [AccountController::class,'update'])->name('admins.update');
    Route::delete('admins/{id}', [AccountController::class,'delete'])->name('admins.delete');
});

Route::group(['middleware' => ['auth:api','role:ADMIN']], function () {
    Route::get('clients', [AccountController::class,'index'])->name('clients.index');
    Route::get('clients/{id}', [AccountController::class,'edit'])->name('clients.edit');
    Route::post('clients', [AccountController::class,'create'])->name('clients.create');
    Route::put('clients/{id}', [AccountController::class,'update'])->name('clients.update');
    Route::delete('clients/{id}', [AccountController::class,'delete'])->name('clients.delete');
});

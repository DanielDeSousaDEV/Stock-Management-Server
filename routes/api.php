<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthenticationController::class, 'login'])->name('login');

Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');

Route::apiResource('category', CategoryController::class);

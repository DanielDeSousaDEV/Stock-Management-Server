<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StockMovementsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthenticationController::class, 'login'])->name('login');

Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');

Route::apiResource('categories', CategoryController::class);

Route::apiResource('stockMovements', StockMovementsController::class);

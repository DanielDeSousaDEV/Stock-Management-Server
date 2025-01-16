<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\StockMovementsController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthenticationController::class, 'login'])->name('login');

Route::post('/signUp', [UserController::class, 'store'])->name('signUP');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');
    
    Route::apiResource('categories', CategoryController::class);
    
    Route::apiResource('stockMovements', StockMovementsController::class)->only([
        'index',
        'store',
        'show'
    ]);
    
    Route::apiResource('products', ProductsController::class)->only([
        'index',
        'store',
        'show'
    ]);
        
    Route::apiResource('locations', LocationsController::class);
});
<?php

use App\Http\Controllers\CategoryController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // $var = Category::factory()
    //                 ->hasProducts(['name'=>'adoado'])->make();

    // $var = Product::factory()->forCategories(['name'=>'ado'])->make();

    $var = Product::factory()->make();

    return dd($var->category);
});

// Route::apiResource('category', CategoryController::class);

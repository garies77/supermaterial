<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;

Route::get('/', function () {
    return view('welcome');
});

// Front-end routes
Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/{slug}', [FrontController::class, 'detail'])->name('detail');
Route::get('/products', [FrontController::class, 'products'])->name('products');
Route::get('/products/{slug}', [FrontController::class, 'productDetail'])->name('product.detail');
Route::get('/articles', [FrontController::class, 'articles'])->name('articles');
Route::get('/articles/{slug}', [FrontController::class, 'articleDetail'])->name('article.detail');

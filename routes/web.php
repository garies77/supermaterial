<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\NewsletterController;
use Illuminate\Support\Facades\Artisan;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/generate-sitemap', function () {
    
    Artisan::call('sitemap:generate');
    return 'Sitemap generated successfully!';
})->middleware('throttle:3,1'); 

// Front-end routes
Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/products', [FrontController::class, 'products'])->name('products');
Route::get('/products/{slug}', [FrontController::class, 'productDetail'])->name('product.detail');
Route::get('/articles', [FrontController::class, 'articles'])->name('articles');
Route::get('/articles/{slug}', [FrontController::class, 'articleDetail'])->name('article.detail');
Route::get('/{slug}', [FrontController::class, 'detail'])->name('detail');

// Newsletter subscription
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

Route::get('/prose-example', function () {
    return view('prose-example');
});




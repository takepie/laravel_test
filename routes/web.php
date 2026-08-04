<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MyPageController;


Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');


Route::get('/product/detail/{id}', [ProductController::class, 'detail'])
    ->name('products.detail');



Route::get('/product/purchase/{id}', [ProductController::class, 'purchase'])
    ->name('products.purchase');

Route::post('/product/purchase/{id}', [ProductController::class, 'buy'])
    ->name('products.buy');


Route::get('/product/create', [ProductController::class, 'create'])
    ->name('products.create');

Route::post('/product/create', [ProductController::class, 'store'])
    ->name('products.store');


Route::get('/product/seller-detail/{id}', [ProductController::class, 'sellerDetail'])
    ->name('products.seller_detail');


Route::get('/product/edit/{id}', [ProductController::class, 'edit'])
    ->name('products.edit');

Route::put('/product/edit/{id}', [ProductController::class, 'update'])
    ->name('products.update');

Route::delete('/product/{id}', [ProductController::class, 'destroy'])
    ->name('products.destroy');

Route::post('/product/{id}/like', [ProductController::class, 'like'])
    ->middleware('auth')
    ->name('products.like');

Route::delete('/product/{id}/like', [ProductController::class, 'unlike'])
    ->middleware('auth')
    ->name('products.unlike');

Route::get('/contact', [ContactController::class, 'index'])
    ->name('contact.index');

Route::post('/contact', [ContactController::class, 'send'])
    ->name('contact.send');


Route::get('/mypage', [MyPageController::class, 'index'])
    ->middleware('auth')
    ->name('mypage');

    
Route::get('/mypage/edit', [MyPageController::class, 'edit'])
    ->middleware('auth')
    ->name('mypage.edit');

Route::put('/mypage/edit', [MyPageController::class, 'update'])
    ->middleware('auth')
    ->name('mypage.update');
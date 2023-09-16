<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();

Route::get('/', App\Http\Controllers\HomeController::class)->name('home');


Route::controller(ProductController::class)->middleware('auth')->group(function (){
    Route::get('show/product/{product:slug}','show')->withoutMiddleware('auth')->name('show.product');
    Route::get('create/product','create')->name('create.product');
    Route::get('edit/product/{product:slug}','edit')->name('edit.product');
    Route::post('upload/product','store')->name('upload.product');
    Route::post('update/product/{product:slug}','update')->name('update.product');
    Route::post('delete/product/{product}','delete')->name('delete.product');
});

Route::controller(CartController::class)->middleware('aith')->group(function (){
    Route::get('cart','getUserCart')->name('cart');
    Route::post('add/cart/{product:slug}','addProductInCart')->name('add.cart');
    Route::post('remove/cart/{cart}','removeProductFromCart')->name('remove.cart');
    Route::post('update/quantity/{cart}','setCartProductQuantity')->name('update.quantity');
});

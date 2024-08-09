<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', [App\Http\Controllers\ProductController::class, 'index'])->name('index');

Route::group(['prefix' => 'cart'], function() {
    Route::get('/', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index')->middleware('no.cache');
    Route::post('/add/{id}', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
});

Route::group(['prefix' => 'orders'], function() {
    Route::post('/', [App\Http\Controllers\OrderController::class, 'store'])->name('order.store');
});

Auth::routes();

Route::group(['prefix' => 'orders', 'middleware' => 'auth'], function() {
    Route::get('/', [App\Http\Controllers\OrderController::class, 'index'])->name('order.index')->middleware('no.cache');
    Route::delete('/{id}', [App\Http\Controllers\OrderController::class, 'destroy'])->name('order.destroy');
});

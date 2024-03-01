<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CartController;
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

Route::get('/', [App\Http\Controllers\FrontController::class, 'index']);

Route::post('cart/add', [App\Http\Controllers\CartController::class, 'add'])->name('add');
Route::get('cart/checkaut', [App\Http\Controllers\CartController::class, 'checkout'])->name('checkout');
//Route::get('cart/clear', [App\Http\Controllers\CartController::class, 'clear'])->name('clear');
//Route::get('cart/removeitem', [App\Http\Controllers\CartController::class, 'removeItem'])->name('removeitem');
Route::delete('cart/removeitem/{rowId}', [App\Http\Controllers\CartController::class, 'removeItem'])->name('removeitem');
Route::patch('cart/update/{rowId}', [App\Http\Controllers\CartController::class, 'update'])->name('update');
Route::get('cart/clear', [CartController::class, 'clear'])->name('clear');
Route::post('cart/clear', [CartController::class, 'clearCart']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

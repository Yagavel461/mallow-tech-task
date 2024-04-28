<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create/product', [ProductController::class, 'create']);
Route::post('/store/product', [ProductController::class, 'store'])->name('products.store');
Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/purchase-histories', [ProductController::class, 'purchaseHistory'])->name('products.purchases');
Route::get('/generatebill', [ProductController::class, 'generateBill'])->name('products.generatebill');
Route::post('/calculate-billing', [ProductController::class, 'calculateBill'])->name('billing.calculate');
Route::get('purchase/details/{id}', [ProductController::class, 'purchaseDetails'])->name('purchase.details');

Route::delete('product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
Route::post('product/update', [ProductController::class, 'update'])->name('product.update');

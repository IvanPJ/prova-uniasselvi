<?php

use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomersController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//consumer routes
Route::get('/customers', [CustomersController::class, 'getAll'])->name('customers.getAll');
Route::post('/customers', [CustomersController::class, 'create'])->name('customers.create');
Route::delete('/customers', [CustomersController::class, 'delete'])->name('customers.delete');

//products routes
Route::get('/products', [ProductsController::class, 'getAll'])->name('products.getAll');
Route::post('/products', [ProductsController::class, 'create'])->name('products.create');
Route::delete('/products', [ProductsController::class, 'delete'])->name('products.delete');

//order routes
Route::get('/order', [OrdersController::class, 'getAll'])->name('order.getAll');
Route::get('/order/all', [OrdersController::class, 'getData'])->name('order.getData');
Route::post('/order', [OrdersController::class, 'create'])->name('order.create');
Route::delete('/order', [OrdersController::class, 'delete'])->name('order.delete');

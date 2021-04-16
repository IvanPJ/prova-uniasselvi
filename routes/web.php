<?php

use App\Http\Controllers\OrdersController;
use Illuminate\Support\Facades\Route;

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
    return view('home');
});

Route::get('/customers', function () {
    return view('registrations/customers');
});

Route::get('/products', function () {
    return view('registrations/products');
});

Route::get('/orders', function () {
    return view('registrations/orders');
});

Route::post('/orders', [OrdersController::class])->name('orders');

//Route::get('/orders', function () {
//    return view('registrations/orders');
//});

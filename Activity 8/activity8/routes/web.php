<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('index');
});


Route::get('/customer/{cusId}/{name}/{addr}', [OrderController::class, 'Customer']);
Route::get('/item/{itemNo}/{name}/{price}', [OrderController::class, 'Item']);
Route::get('/order/{cusId}/{name}/{orderNo}/{date}', [OrderController::class, 'Order']);
Route::get('/orderdetails/{transNo}/{orderNo}/{itemId}/{name}/{price}/{qty}', [OrderController::class, 'OrderDetails']);

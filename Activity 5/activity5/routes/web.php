<?php

use App\Http\Controllers\CalcuController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/{operation}/{value1}/{value2}',[CalcuController::class,'calculate']);

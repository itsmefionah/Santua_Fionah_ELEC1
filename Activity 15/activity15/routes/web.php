<?php

use App\Http\Controllers\JokeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', [JokeController::class, 'index'])->name('index');
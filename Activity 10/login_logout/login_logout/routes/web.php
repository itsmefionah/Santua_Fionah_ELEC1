<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Authenticated
Route::middleware('auth')->get('/dashboard', [DashboardController::class,'home'])->name('dashboard');

//Register
Route::get('/register',[RegisterController::class,'showRegistrationForm'])->name('register');
Route::post('/register',[RegisterController::class, 'register']);

//Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
//Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


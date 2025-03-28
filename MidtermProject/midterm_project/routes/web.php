<?php

use App\Http\Controllers\MaintenanceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssetController;

Route::get('/', function () {
    return view('welcome');
});



//assets 
Route::get('/assets', [AssetController::class, 'index'])->name('home');
Route::get('/assets/create', [AssetController::class, 'insertForm'])->name('create');
Route::post('/assets', [AssetController::class, 'insert'])->name('store');
Route::get('/assets/{id}/edit', [AssetController::class, 'showEdit'])->name('edit');
Route::post('/assets/{id}', [AssetController::class, 'edit'])->name('update');
Route::get('/assets/{id}', [AssetController::class, 'delete'])->name('destroy');
Route::get('/maintenance/history/{id}', [AssetController::class, 'maintenanceHistory'])->name('history');

//maintenance
Route::get('/assets/{id}/maintenance', [MaintenanceController::class, 'showMaintenance'])->name('mindex');
Route::get('/assets/{id}/maintenance/add', [MaintenanceController::class, 'AddMaintenance'])->name('madd');
Route::post('/assets/{id}/maintenance', [MaintenanceController::class, 'insertAssetMaintenance'])->name('mstore');

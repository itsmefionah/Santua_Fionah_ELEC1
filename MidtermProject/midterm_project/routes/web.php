<?php

use App\Http\Controllers\MaintenanceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssetController;

Route::get('/', function () {
    return view('welcome');
});



//assets 
Route::get('/assets', [AssetController::class, 'index'])->name('home');
Route::get('/assets/details/{location_id}', [AssetController::class, 'details'])->name('details');
Route::get('/assets/assigned/{name}', [AssetController::class, 'assignedAssets'])->name('assigned');
Route::get('/assets/assignedToPerson/{name}', [AssetController::class, 'assignedToPerson'])->name('assignedToPerson');
Route::get('/assets/create', [AssetController::class, 'insertForm'])->name('create');
Route::post('/assets', [AssetController::class, 'insert'])->name('store');
Route::get('/assets/{id}/edit', [AssetController::class, 'showEdit'])->name('edit');
Route::post('/assets/update/{id}', [AssetController::class, 'edit'])->name('update');
Route::get('/assets/{id}', [AssetController::class, 'delete'])->name('destroy');

//maintenance
Route::get('/assets/{id}/maintenance', [MaintenanceController::class, 'showMaintenance'])->name('mindex');
Route::get('/assets/{id}/maintenance/add', [MaintenanceController::class, 'AddMaintenance'])->name('madd');
Route::post('/assets/{id}/maintenance', [MaintenanceController::class, 'insertAssetMaintenance'])->name('mstore');
Route::get('/maintenance/{id}/edit/{record_id}', [MaintenanceController::class, 'editMaintenance'])->name('medit');
Route::post('/maintenance/{id}/update/{record_id}', [MaintenanceController::class, 'updateMaintenance'])->name('mupdate');
Route::get('/maintenance/{id}/delete/{record_id}', [MaintenanceController::class, 'deleteMaintenance'])->name('mdelete');
Route::get('/assets/{id}/maintenanceHistory',[MaintenanceController::class,'showMaintenanceHistory'])->name('mhistory');
<?php

use App\Http\Controllers\AdminStaffController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\StaffController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\Authorize;

Route::get('/', function () {
    return view('welcome');
});



//assets 
Route::get('/search', [AssetController::class, 'search'])->name('search');
Route::get('/assets', [AssetController::class, 'index'])->name('home')->middleware('auth');
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

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware(['auth', Authorize::class])->group(function () {
    Route::get('/assets', [AssetController::class, 'index'])->name('home');
    Route::get('/admin/staff/create', [AdminStaffController::class, 'create'])->name('staff.create');
    Route::post('/admin/staff', [AdminStaffController::class, 'store'])->name('staff.store');
});


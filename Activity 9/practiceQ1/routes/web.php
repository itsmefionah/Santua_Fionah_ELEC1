<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\TriangleController;
use Illuminate\Support\Facades\Route;


// Route::get('/triangle/{size}', [TriangleController::class, 'generateTriangle']);
Route::get('insert',[StudentController::class, 'insertform'])->name("insert");
Route::post('create',[StudentController::class, 'insert'])->name("create");
Route::get('/',[StudentController::class, "index"])->name("home");
Route::get("/delete/{Id}",[StudentController::class,"destroy"])->name("delete");
Route::post("/edit/{Id}", [StudentController::class, "edit"])->name("edit");


Route::get('edit/{id}',[StudentController::class, 'showEdit'])->name("showEdit");

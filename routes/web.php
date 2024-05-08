<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\UserController;

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
Route::get('/', [UserController::class,'home']);
Route::get('/fetchuser', [UserController::class,'index'])->name('index');
Route::post('/adduser',[UserController::class,'add'])->name('add');
Route::post('/filter',[UserController::class,'datefilter'])->name('datefilter');
Route::get('/downloadPDF', [UserController::class,'downloadPDF'])->name('downloadPDF');
Route::get('/edit/{id}',[UserController::class, 'edit'])->name('edit');
Route::put('/update/{id}',[UserController::class, 'update'])->name('update');
Route::post('/deleteuser/{id}',[UserController::class,'delete'])->name('delete');

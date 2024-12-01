<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\CostumeController;
use App\Http\Controllers\UserController;

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

Route::get('/', [LandingPageController::class, 'index'])->name('landingpage');

Route::prefix('/costume')->name('costume.')->group(function(){
    Route::get('/gallery', [CostumeController::class, 'index'])->name('gallery');
    Route::get('/create', [CostumeController::class, 'create'])->name('form');
    Route::post('/store', [CostumeController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [CostumeController::class, 'edit'])->name('form.edit');
    Route::patch('/update/{id}', [CostumeController::class, 'update'])->name('form.update');
    Route::delete('/delete/{id}', [CostumeController::class, 'destroy'])->name('delete');
});

Route::prefix('/user')->name('user.')->group(function(){
    Route::get('/table', [UserController::class, 'index'])->name('table');
    Route::get('/create', [UserController::class, 'create'])->name('form');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('form.edit');
    Route::patch('/update/{id}', [UserController::class, 'update'])->name('form.update');
    Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('delete');
});

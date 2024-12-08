<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\CostumeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/Route::middleware(['IsGuest'])->group(function () {
    Route::get('/', [UserController::class, 'showLogin'])->name('login.auth');
    Route::post('/login', [UserController::class, 'loginAuth'])->name('login');
});

Route::middleware(['IsLogin'])->group(function () {
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/landing', [LandingPageController::class, 'index'])->name('landingpage');
    Route::get('/costume/gallery', [CostumeController::class, 'index'])->name('costume.gallery');
    Route::get('/costume/struk/{id}', [CostumeController::class, 'struk'])->name('costume.struk');

    // Routes accessible by IsAdmin
    Route::middleware(['IsAdmin'])->group(function () {
        Route::prefix('/user')->name('user.')->group(function() {
            Route::get('/table', [UserController::class, 'index'])->name('table');
            Route::get('/create', [UserController::class, 'create'])->name('form');
            Route::post('/store', [UserController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('form.edit');
            Route::patch('/update/{id}', [UserController::class, 'update'])->name('form.update');
            Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('delete');
        });
        Route::prefix('/costume')->name('costume.')->group(function() {
            Route::get('/create', [CostumeController::class, 'create'])->name('form');
            Route::post('/store', [CostumeController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [CostumeController::class, 'edit'])->name('form.edit');
            Route::patch('/update/{id}', [CostumeController::class, 'update'])->name('form.update');
            Route::delete('/delete/{id}', [CostumeController::class, 'destroy'])->name('delete');
            Route::get('/download', [CostumeController::class, 'download'])->name('download');
        });
    });
        Route::prefix('/order')->name('order.')->group(function() {
            Route::get('/pesan', [OrderController::class, 'index'])->name('pesan');
            Route::get('/create-order', [OrderController::class, 'create'])->name('create');
            Route::post('/keranjang', [OrderController::class, 'store'])->name('keranjang');
            Route::get('/chartadd', [OrderController::class, 'show'])->name('chartadd');
        });
});

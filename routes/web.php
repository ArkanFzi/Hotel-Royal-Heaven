<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\PemesananController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', [KamarController::class, 'index'])->name('home');

// Admin dashboard
Route::get('admin', function () {
    return view('admin.index');
})->name('admin.index');

// Auth
Route::get('register', [AuthController::class, 'showRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Password reset
Route::get('password/forgot', [AuthController::class, 'showForgot'])->name('password.request');
Route::post('password/email', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [AuthController::class, 'reset'])->name('password.update');

// Kamar - admin resource
Route::middleware(['auth',])->group(function(){
    Route::resource('kamar', KamarController::class)->except(['show']);
    Route::get('pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');
    Route::post('pemesanan/{pemesanan}/status', [PemesananController::class, 'updateStatus'])->name('pemesanan.updateStatus');
});

// Member routes
Route::middleware(['auth'])->group(function(){
    Route::get('pemesanan/create', [PemesananController::class, 'create'])->name('pemesanan.create');
    Route::post('pemesanan', [PemesananController::class, 'store'])->name('pemesanan.store');
    Route::get('pemesanan/mine', [PemesananController::class, 'index'])->name('pemesanan.mine');
    Route::get('pemesanan/{pemesanan}', [PemesananController::class, 'show'])->name('pemesanan.show');
});

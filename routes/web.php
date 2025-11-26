<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminMemberController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\KamarController;
use App\Http\Controllers\Admin\PemesananController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Member\KamarController as MemberKamarController;
use App\Http\Controllers\Member\ProfileController as MemberProfileController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use Illuminate\Support\Facades\Auth;

// Public landing page (controller-driven to fetch featured rooms)
// Use the member-facing KamarController@index so we don't call a non-existent admin method.
Route::get('/', [MemberKamarController::class, 'index'])->name('landing');

Route::get('/home', function () {
    return view('home');
})->name('home');

// Daftar kamar route accessible publicly for both guests and members
Route::get('/daftarkamar', [KamarController::class, 'index'])->name('daftarkamar');

// About page
Route::get('/about', function () {
    return view('about');
})->name('about');

// Admin dashboard - protected by IsAdmin middleware
Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard.index');
    
    Route::resource('kamar', KamarController::class)->except(['show']);
    Route::get('pemesanan', [PemesananController::class, 'index'])->name('admin.pemesanan.index');
    Route::post('pemesanan/{pemesanan}/status', [PemesananController::class, 'updateStatus'])->name('pemesanan.updateStatus');

    // Management Member routes for admin
    Route::get('admin/members', [AdminMemberController::class, 'index'])->name('admin.members.index');
    Route::get('admin/members/create', [AdminMemberController::class, 'create'])->name('admin.members.create');
    Route::post('admin/members', [AdminMemberController::class, 'store'])->name('admin.members.store');
    Route::get('admin/members/{member}/edit', [AdminMemberController::class, 'edit'])->name('admin.members.edit');
    Route::put('admin/members/{member}', [AdminMemberController::class, 'update'])->name('admin.members.update');
    Route::delete('admin/members/{member}', [AdminMemberController::class, 'destroy'])->name('admin.members.destroy');
});

// Auth
// Override register routes to prevent admin from registering
Route::get('register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('register', [AuthController::class, 'register'])->middleware('guest');
Route::get('login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('login', [AuthController::class, 'login'])->middleware('guest');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Password reset
Route::get('password/forgot', [AuthController::class, 'showForgot'])->name('password.request');
Route::post('password/email', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [AuthController::class, 'reset'])->name('password.update');

// Member routes - protected by auth middleware and prefixed with 'member'
Route::prefix('member')->name('member.')->middleware(['auth'])->group(function(){
    Route::get('pemesanan/create', [PemesananController::class, 'create'])->name('pemesanan.create');
    Route::post('pemesanan', [PemesananController::class, 'store'])->name('pemesanan.store');
    Route::get('pemesanan/my', [PemesananController::class, 'myBookings'])->name('pemesanan.my');
    Route::get('pemesanan/{pemesanan}', [PemesananController::class, 'show'])->name('pemesanan.show');
    Route::delete('pemesanan/{pemesanan}/cancel', [PemesananController::class, 'cancelBooking'])->name('pemesanan.cancel');
    Route::post('pemesanan/{pemesanan}/status', [PemesananController::class, 'updateStatus'])->name('pemesanan.updateStatus');
    Route::post('reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('profile', [MemberProfileController::class, 'show'])->name('profile');
    Route::put('profile', [MemberProfileController::class, 'update'])->name('profile.update');
});

// Additional member dashboard route
Route::get('member', [App\Http\Controllers\Member\DashboardController::class, 'index'])->name('member.index')->middleware('auth');

// Midtrans payment notification webhook endpoint (public)
Route::post('/midtrans/notification', [PemesananController::class, 'midtransNotification'])->name('midtrans.notification');

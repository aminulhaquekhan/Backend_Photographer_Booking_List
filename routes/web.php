<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PhotographerController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Landing Page
Route::get('/', function () {
    return redirect()->route('photographers.index');
});

// Auth: Login/Logout
Route::get('login', function () {
    return view('auth.login');
})->name('login');

Route::post('login', [AdminController::class, 'login']);
Route::post('logout', [AdminController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Public Booking Routes (for visitors/customers)
|--------------------------------------------------------------------------
*/
Route::resource('users', \App\Http\Controllers\UserController::class);
// Booking Form (create + store)
Route::resource('bookings', BookingController::class)->only(['create', 'store', 'index', 'update', 'show']);

// Publicly Viewable Photographers List + Profile
Route::resource('photographers', PhotographerController::class)->only(['index', 'show']);

/*
|--------------------------------------------------------------------------
| Admin Routes (Protected by auth + admin middleware)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Full Booking Management (index, edit, update, delete, show)
    Route::resource('bookings', BookingController::class)->except(['create', 'store', 'index']);

    // Full Photographer Management (create, store, edit, update, delete)
    Route::resource('photographers', PhotographerController::class);
});
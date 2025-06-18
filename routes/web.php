<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DeviceController;
use App\Http\Controllers\Customer\Auth\LoginController as CustomerLoginController;
use App\Http\Controllers\Customer\Auth\RegisterController as CustomerRegisterController;
use App\Http\Controllers\Customer\DashboardController;
use App\Http\Controllers\Customer\DeviceController as CustomerDeviceController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Xodimlar (Admin) uchun Kirish Yo'llari
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login']);
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

    Route::middleware('auth:web')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('customers', CustomerController::class);
        Route::resource('devices', DeviceController::class);

        Route::post('/devices/{device}/change-status', [DeviceController::class, 'changeStatus'])->name('devices.changeStatus');
        Route::post('/devices/{device}/release', [DeviceController::class, 'releaseDevice'])->name('devices.release');
    });

});

Route::name('customer.')->group(function () {
    Route::middleware('guest:customers')->group(function () {
        Route::get('/login', [CustomerLoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [CustomerLoginController::class, 'login']);
        Route::get('/register', [CustomerRegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('/register', [CustomerRegisterController::class, 'register']);
    });

    Route::middleware('auth:customers')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [CustomerLoginController::class, 'logout'])->name('logout');

        Route::post('/devices/{device}/change-status', [DashboardController::class, 'changeDeviceStatus'])->name('devices.changeStatus');
        Route::get('/devices/create', [CustomerDeviceController::class, 'create'])->name('devices.create');
        Route::post('/devices', [CustomerDeviceController::class, 'store'])->name('devices.store');
    });
});


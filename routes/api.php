<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DeviceController;

// Ochiq marshrutlar (token talab qilinmaydi)
Route::post('/customer/login', [AuthController::class, 'login']);

// Himoyalangan marshrutlar (faqat token bilan kirish mumkin)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/customer/verify-device', [AuthController::class, 'verifyDevice']);
    Route::post('/customer/logout', [AuthController::class, 'logout']);
    Route::post('/device/status', [DeviceController::class, 'getStatus']);
});

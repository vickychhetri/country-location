<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PostalCodeController;


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('reset-password', [AuthController::class, 'resetPassword']);

Route::middleware('auth:sanctum')->group(function () {
    //All
    Route::get('postal-codes', [PostalCodeController::class, 'index']);
    // GET /api/postal-codes/{postalCode}
    Route::get('postal-codes/{postalCode}', [PostalCodeController::class, 'show']);

    //GET /api/postal-codes/nearby?latitude=19.36&longitude=73.32&radius=15
    Route::get('postal-codes/nearby/area', [PostalCodeController::class, 'nearby_v2']);


    Route::post('logout', [AuthController::class, 'logout']);
});


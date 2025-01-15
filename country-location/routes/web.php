<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return response()->json([
        'status' => 'error',
        'message' => '401 Unauthorized Error !',
    ],404);
})->name('login');

Route::get('/', function () {
    return view('welcome');
});
Route::get('/api-documentation', function () {
    return view('welcome');
});

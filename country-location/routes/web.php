<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return response()->json([
        'status' => 'Error',
        'message' => 'Something Went Wrong!',
    ],404);
});

Route::get('/', function () {
    return view('welcome');
});
Route::get('/api-documentation', function () {
    return view('welcome');
});

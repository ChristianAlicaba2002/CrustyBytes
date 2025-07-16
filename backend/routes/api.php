<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ProductAPIController;
use App\Http\Controllers\API\Order\OrderController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/storage/{imageName}', function ($imageName) {
    return response()->file(public_path('images/' . $imageName));
});

//User Routes
Route::resource('/users', UserController::class);

//Product Routes
Route::resource('/products', ProductAPIController::class);

//Order Routes
Route::resource('/orders', OrderController::class);
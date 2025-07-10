<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductAPIController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/storage/{imageName}', function ($imageName) {
    return response()->file(public_path('images/' . $imageName));
});

Route::get('/products', [ProductAPIController::class , 'displayAllProducts']);
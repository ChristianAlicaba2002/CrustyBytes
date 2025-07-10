<?php

use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Product\ProductController;

Route::get('/', function () {
    if(Auth::guard('admin')->check()) {
        return redirect()->route('admin.dashboard');
    }
    return view('Auth.Login');
})->name('login.view');



Route::middleware(['auth:admin'])->group(function () {
    Route::get('/dashboard', function () {
        $items = Products::orderBy('created_at', 'desc')->get();
        return view('pages.Dashboard', compact('items'));
    })->name('admin.dashboard')->middleware(AdminMiddleware::class);
});




//Admin Routes
Route::post('/login',[AdminController::class, 'login'])->name('login.admin');
Route::post('/logout',[AdminController::class, 'logout'])->name('logout.admin');


//Product Routes
Route::post('/add_product', [ProductController::class , 'create'])->name('create.product');
Route::post('/update_product/{id}',[ProductController::class , 'update'])->name('update.product');
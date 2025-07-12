<?php

use App\Models\Products;
use App\Models\ArchiveItems;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Middleware\PreventBackHistory;
use App\Models\User;

Route::get('/', function () {
    if (Auth::guard('admin')->check()) {
        return redirect()->route('admin.dashboard');
    }
    return view('Auth.Login');
})->name('login');


Route::middleware('auth:admin')->group(function () {

    Route::get('/dashboard', function () {
        $items = Products::orderBy('created_at', 'desc')->paginate(4);
        $totalItems = Products::all();
        $totalUser  = User::all();
        return view('pages.Dashboard', compact('items', 'totalItems','totalUser'));
    })->name('admin.dashboard');

    Route::get('/archive', function () {
        $archiveItems = ArchiveItems::orderBy('created_at', 'desc')->get();
        return view('pages.ArchiveItem', compact('archiveItems'));
    })->name('admin.archive');
});




//Admin Routes
Route::controller(AdminController::class)->group(function () {
    Route::post('/login', 'login')->name('login.admin');
    Route::post('/logout', 'logout')->name('logout.admin');
});


//Product Routes
Route::controller(ProductController::class)->group(function () {
    Route::post('/add_product', 'create')->name('create.product');
    Route::put('/update/product/{id}', 'update')->name('update.product');
    Route::delete('/archive/product/{id}', 'archive')->name('archive.product');
    Route::delete('/delete/product/{id}', 'delete')->name('delete.product');
});

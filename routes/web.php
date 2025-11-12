<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // User Management Routes
    Route::get('/User', function () {
        return view('user.user-list');
    })->name('users.index');

    Route::get('/Roles', function () {
        return view('Roles.roles-permissions');
    })->name('roles-permissions');
    
    // Inventory Management Routes
    Route::get('/Inventory', function () {
        return view('inventory.product-list');
    })->name('inventory.productlist');

     Route::get('/stockin', function () {
        return view('StockIn.stockin');
    })->name('StockIn.stockin');

     Route::get('/stockout', function () {
        return view('Stockout.stockout');
    })->name('Stockout.stockout');

        Route::get('/stockadjustment', function () {
        return view('Stockadjustment.stockadjustment');
    })->name('Stockadjustment.stockadjustment');
});

require __DIR__.'/auth.php';
<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

// Dashboard — redirects based on role
Route::get('/dashboard', function () {
    if (auth()->user()->usertype === 'admin') {
        return redirect()->route('menu.manage');
    }
    return redirect()->route('menu.pax');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Normal user: pax & budget form
    Route::get('/menu/pax', [MenuController::class, 'pax'])->name('menu.pax');
    Route::post('/menu/pax', [MenuController::class, 'storePax'])->name('menu.storePax');

    // Normal user: browse menu (requires pax session)
    Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');

    // Normal user: enter customer info
    Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');

    // Admin-only routes
    Route::middleware('admin')->group(function () {
        Route::get('/menu/manage', [MenuController::class, 'manage'])->name('menu.manage');
        Route::get('/menu/create', [MenuController::class, 'create'])->name('menu.create');
        Route::post('/menu', [MenuController::class, 'store'])->name('menu.store');
        Route::get('/menu/{menu}/edit', [MenuController::class, 'edit'])->name('menu.edit');
        Route::put('/menu/{menu}', [MenuController::class, 'update'])->name('menu.update');
        Route::delete('/menu/{menu}', [MenuController::class, 'destroy'])->name('menu.destroy');

        // View Customers
        Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    });
});

require __DIR__.'/auth.php';

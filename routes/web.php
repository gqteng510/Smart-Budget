<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

// Dashboard — redirects or shows customer portal
Route::get('/dashboard', function () {
    if (auth()->user()->usertype === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    
    $user = auth()->user();
    $totalOrders = $user->orders()->count();
    $totalSpent = $user->orders()->whereIn('status', ['accepted', 'completed'])->sum('total_price');
    $completedOrders = $user->orders()->where('status', 'completed')->count();
    
    return view('dashboard', compact('totalOrders', 'totalSpent', 'completedOrders'));
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

    // Cart routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{menu}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update/{menu}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{menu}', [CartController::class, 'remove'])->name('cart.remove');

    // Customer order routes
    Route::get('/order/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
    Route::post('/order/place', [OrderController::class, 'store'])->name('order.place');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    // Admin-only routes
    Route::middleware('admin')->group(function () {
        Route::get('/admin/dashboard', [OrderController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::get('/menu/manage', [MenuController::class, 'manage'])->name('menu.manage');
        Route::get('/menu/create', [MenuController::class, 'create'])->name('menu.create');
        Route::post('/menu', [MenuController::class, 'store'])->name('menu.store');
        Route::get('/menu/{menu}/edit', [MenuController::class, 'edit'])->name('menu.edit');
        Route::put('/menu/{menu}', [MenuController::class, 'update'])->name('menu.update');
        Route::delete('/menu/{menu}', [MenuController::class, 'destroy'])->name('menu.destroy');

        // View Customers
        Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
        Route::get('/customers/{user}/orders', [CustomerController::class, 'customerOrders'])->name('customers.orders');

        // Admin Order Management routes
        Route::get('/admin/orders', [OrderController::class, 'adminIndex'])->name('admin.orders');
        Route::patch('/admin/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.status');
    });
});

require __DIR__.'/auth.php';

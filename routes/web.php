<?php

use App\Http\Controllers\CheckoutController;

Route::get('/checkout/menu', [CheckoutController::class, 'menuIndex'])->name('checkout.menu');

Route::post('/checkout/save-menu', [CheckoutController::class, 'saveMenu'])->name('checkout.saveMenu');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');


Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.place');

Route::get('/checkout/success/{id}', [CheckoutController::class, 'success'])->name('checkout.success');


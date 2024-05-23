<?php

use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

Route::get('/stripe', [StripeController::class, 'index'])->name('stripe.index');
Route::post('/stripe', [StripeController::class, 'store'])->name('stripe.store');
Route::post('/stripe/fallback', [StripeController::class, 'fallback'])->name('stripe.fallback');
Route::get('/stripe/success', [StripeController::class, 'success'])->name('stripe.success');
Route::get('/stripe/cancel', [StripeController::class, 'cancel'])->name('stripe.cancel');

Route::get('/orders', [OrdersController::class, 'index'])->name('orders.index');


require __DIR__.'/auth.php';

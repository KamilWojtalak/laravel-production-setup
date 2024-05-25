<?php

use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\StripeSubscriptionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

Route::prefix('/stripe')
    ->name('stripe.')
    ->group(function () {
        Route::get('', [StripeController::class, 'index'])->name('index');
        Route::post('', [StripeController::class, 'store'])->name('store');
        Route::post('/fallback', [StripeController::class, 'fallback'])->name('fallback');
        Route::get('/success', [StripeController::class, 'success'])->name('success');
        Route::get('/cancel', [StripeController::class, 'cancel'])->name('cancel');

        Route::prefix('/subscription')
            ->name('subscription.')
            ->group(function () {
                Route::get('/', [StripeSubscriptionController::class, 'index'])
                    ->name('index');
                Route::post('/', [StripeSubscriptionController::class, 'store'])
                    ->name('store');
                Route::get('/success', [StripeSubscriptionController::class, 'success'])
                    ->name('success');
                Route::get('/cancel', [StripeSubscriptionController::class, 'cancel'])
                    ->name('cancel');
                Route::post('/create-portal-session', [StripeSubscriptionController::class, 'createPortalSession'])
                    ->name('create-portal-session');
                Route::post('/fallback', [StripeSubscriptionController::class, 'fallback'])
                    ->name('fallback');
            });
    });

Route::get('/orders', [OrdersController::class, 'index'])->name('orders.index');

require __DIR__ . '/auth.php';

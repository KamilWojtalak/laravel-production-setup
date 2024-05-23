<?php

use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

Route::get('/stripe', [StripeController::class, 'index'])->name('stripe.index');

require __DIR__.'/auth.php';

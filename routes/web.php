<?php

use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\MollieWebhookController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', function () {
    return view('products');
});

Route::middleware('auth')->group(function () {
    Route::get('subscribe', [SubscriptionController::class, 'showSubscribePage'])->name('subscribe.page');
    Route::post('subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe.post');
    Route::get('subscription/{subscription}/cancel', [SubscriptionController::class, 'cancel'])->name('subscription.cancel');
    Route::get('subscription/{subscription}/resume', [SubscriptionController::class, 'resume'])->name('subscription.resume');
    Route::get('subscription/{subscription}/invoices', [SubscriptionController::class, 'invoices'])->name('subscription.invoices');
});
Route::post('webhooks/mollie', [MollieWebhookController::class, 'handle'])->name('webhooks.mollie');
/*Route::post('mollie/webhook', \Laravel\Cashier\Mollie\Http\Controllers\WebhookController::class);*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

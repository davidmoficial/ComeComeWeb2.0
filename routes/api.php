<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('/pagarme')->group(function() {
    Route::prefix('/customers')->group(function(){
        Route::post('/store/{marketId}', [PaymentController::class, 'storeClient'])->name('payment.customers.store.client');
    });
});

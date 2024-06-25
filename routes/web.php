<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MpesaController;

// Route for the welcome page
Route::get('/', function () {
    return view('welcome');
});

// Route to initiate M-Pesa STK Push
Route::post('/mpesa/stkpush', [MpesaController::class, 'initiateStkPush']);

// Route to handle M-Pesa callback
Route::post('/mpesa/callback', [MpesaController::class, 'callback']);

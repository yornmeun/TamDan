<?php

use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index']);


// Route::get('/test-error', function () {
//     throw new Exception('TEST ERROR');
// });
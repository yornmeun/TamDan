<?php

use App\Http\Controllers\DownloadInvoicePdfController;
use App\Http\Controllers\DownloadQuotationPdfController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/invoices/{invoice}/download-pdf', DownloadInvoicePdfController::class)
        ->name('invoices.download-pdf');

    Route::get('/quotations/{quotation}/download-pdf', DownloadQuotationPdfController::class)
        ->withTrashed()
        ->name('quotations.download-pdf');
});

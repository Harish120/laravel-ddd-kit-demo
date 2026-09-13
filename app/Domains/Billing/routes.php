<?php

declare(strict_types=1);

use App\Domains\Billing\Infrastructure\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::prefix('billing')->middleware('web')->group(function (): void {
    Route::get('invoices', [InvoiceController::class, 'index'])->name('billing.invoices.index');
});

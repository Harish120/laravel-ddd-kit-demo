<?php

declare(strict_types=1);

use App\Domains\Contact\Infrastructure\Http\Controllers\LeadController;
use Illuminate\Support\Facades\Route;

Route::prefix('contact')->middleware('web')->group(function (): void {
    Route::get('leads', [LeadController::class, 'index'])->name('contact.leads.index');
    Route::post('leads', [LeadController::class, 'store'])->name('contact.leads.store');
});

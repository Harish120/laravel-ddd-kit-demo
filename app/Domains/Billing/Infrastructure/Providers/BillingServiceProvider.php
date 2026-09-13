<?php

declare(strict_types=1);

namespace App\Domains\Billing\Infrastructure\Providers;

use App\Domains\Billing\Application\Listeners\CreateInvoiceOnLeadWasCreated;
use App\Domains\Contact\Domain\Events\LeadWasCreated;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

final class BillingServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind repository interfaces to their Eloquent implementations here.
        // Added automatically by `ddd:repository`.
        $this->app->bind(\App\Domains\Billing\Domain\Repositories\InvoiceRepository::class, \App\Domains\Billing\Infrastructure\Persistence\Repositories\EloquentInvoiceRepository::class);
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes.php');
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');

        Event::listen(LeadWasCreated::class, CreateInvoiceOnLeadWasCreated::class);
    }
}

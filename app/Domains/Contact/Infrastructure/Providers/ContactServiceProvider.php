<?php

declare(strict_types=1);

namespace App\Domains\Contact\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;

final class ContactServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind repository interfaces to their Eloquent implementations here.
        // Added automatically by `ddd:repository`.
        $this->app->bind(\App\Domains\Contact\Domain\Repositories\LeadRepository::class, \App\Domains\Contact\Infrastructure\Persistence\Repositories\EloquentLeadRepository::class);
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes.php');
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
    }
}

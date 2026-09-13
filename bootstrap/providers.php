<?php

use App\Providers\AppServiceProvider;

return [
    AppServiceProvider::class,
    App\Domains\Contact\Infrastructure\Providers\ContactServiceProvider::class,
    App\Domains\Billing\Infrastructure\Providers\BillingServiceProvider::class,
];

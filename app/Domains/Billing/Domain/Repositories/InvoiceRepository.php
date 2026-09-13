<?php

declare(strict_types=1);

namespace App\Domains\Billing\Domain\Repositories;

use App\Domains\Billing\Domain\Entities\Invoice;

interface InvoiceRepository
{
    public function find(string $id): ?Invoice;

    public function save(Invoice $invoice): void;
}

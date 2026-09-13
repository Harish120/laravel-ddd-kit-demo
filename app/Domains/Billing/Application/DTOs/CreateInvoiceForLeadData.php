<?php

declare(strict_types=1);

namespace App\Domains\Billing\Application\DTOs;

final readonly class CreateInvoiceForLeadData
{
    public function __construct(
        public string $leadId,
        public int $amountCents = 5000,
    ) {}
}

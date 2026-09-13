<?php

declare(strict_types=1);

namespace App\Domains\Billing\Application\Listeners;

use App\Domains\Billing\Application\DTOs\CreateInvoiceForLeadData;
use App\Domains\Billing\Application\UseCases\CreateInvoiceForLead;
use App\Domains\Contact\Domain\Events\LeadWasCreated;

final class CreateInvoiceOnLeadWasCreated
{
    public function __construct(
        private readonly CreateInvoiceForLead $createInvoiceForLead,
    ) {}

    public function handle(LeadWasCreated $event): void
    {
        $this->createInvoiceForLead->handle(new CreateInvoiceForLeadData(leadId: $event->aggregateId));
    }
}

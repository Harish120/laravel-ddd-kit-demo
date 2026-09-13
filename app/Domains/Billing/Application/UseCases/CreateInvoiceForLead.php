<?php

declare(strict_types=1);

namespace App\Domains\Billing\Application\UseCases;

use App\Domains\Billing\Application\DTOs\CreateInvoiceForLeadData;
use App\Domains\Billing\Domain\Entities\Invoice;
use App\Domains\Billing\Domain\Repositories\InvoiceRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

final class CreateInvoiceForLead
{
    public function __construct(
        private readonly InvoiceRepository $invoices,
    ) {}

    public function handle(CreateInvoiceForLeadData $data): void
    {
        DB::transaction(function () use ($data): void {
            $aggregate = Invoice::create(Str::uuid()->toString(), $data->leadId, $data->amountCents);

            $this->invoices->save($aggregate);

            // Invoice records no domain events of its own in this demo —
            // nothing downstream needs to react to an invoice being created.
        });
    }
}

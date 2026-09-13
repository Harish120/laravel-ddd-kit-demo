<?php

declare(strict_types=1);

use App\Domains\Billing\Application\DTOs\CreateInvoiceForLeadData;
use App\Domains\Billing\Application\UseCases\CreateInvoiceForLead;
use App\Domains\Billing\Domain\Entities\Invoice;
use App\Domains\Billing\Domain\Repositories\InvoiceRepository;

final class InMemoryInvoiceRepository implements InvoiceRepository
{
    /** @var array<string, Invoice> */
    public array $saved = [];

    public function find(string $id): ?Invoice
    {
        return $this->saved[$id] ?? null;
    }

    public function save(Invoice $invoice): void
    {
        $this->saved[$invoice->id()] = $invoice;
    }
}

it('creates a pending invoice for the given lead', function (): void {
    $repository = new InMemoryInvoiceRepository();
    $useCase = new CreateInvoiceForLead($repository);

    $useCase->handle(new CreateInvoiceForLeadData(leadId: 'lead-1', amountCents: 5000));

    expect($repository->saved)->toHaveCount(1);

    $invoice = array_values($repository->saved)[0];
    expect($invoice->leadId())->toBe('lead-1')
        ->and($invoice->amountCents())->toBe(5000)
        ->and($invoice->status())->toBe('pending');
});

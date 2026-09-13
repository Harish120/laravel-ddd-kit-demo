<?php

declare(strict_types=1);

use App\Domains\Billing\Domain\Entities\Invoice;

it('creates a new Invoice in pending status', function (): void {
    $aggregate = Invoice::create('1', 'lead-1', 5000);

    expect($aggregate->id())->toBe('1')
        ->and($aggregate->leadId())->toBe('lead-1')
        ->and($aggregate->amountCents())->toBe(5000)
        ->and($aggregate->status())->toBe('pending');
});

it('reconstitutes an Invoice from persisted state without recording new events', function (): void {
    $aggregate = Invoice::reconstitute('1', 'lead-1', 5000, 'paid');

    expect($aggregate->status())->toBe('paid')
        ->and($aggregate->pullDomainEvents())->toBe([]);
});

it('marks an invoice as paid via a named intent method', function (): void {
    $aggregate = Invoice::create('1', 'lead-1', 5000);

    $aggregate->markPaid();

    expect($aggregate->status())->toBe('paid');
});

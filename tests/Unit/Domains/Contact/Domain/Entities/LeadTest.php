<?php

declare(strict_types=1);

use App\Domains\Contact\Domain\Entities\Lead;
use App\Domains\Contact\Domain\Events\LeadWasCreated;
use App\Domains\Contact\Domain\ValueObjects\Email;

it('creates a new Lead and exposes its id and email', function (): void {
    $aggregate = Lead::create('1', new Email('lead@example.com'));

    expect($aggregate->id())->toBe('1')
        ->and($aggregate->email()->equals(new Email('lead@example.com')))->toBeTrue();
});

it('records a LeadWasCreated event on creation', function (): void {
    $aggregate = Lead::create('1', new Email('lead@example.com'));

    $events = $aggregate->pullDomainEvents();

    expect($events)->toHaveCount(1)
        ->and($events[0])->toBeInstanceOf(LeadWasCreated::class);
});

it('reconstitutes a Lead from persisted state without recording new events', function (): void {
    $aggregate = Lead::reconstitute('1', new Email('lead@example.com'));

    expect($aggregate->pullDomainEvents())->toBe([]);
});

it('pulling domain events clears them', function (): void {
    $aggregate = Lead::create('1', new Email('lead@example.com'));

    $aggregate->pullDomainEvents();

    expect($aggregate->pullDomainEvents())->toBe([]);
});

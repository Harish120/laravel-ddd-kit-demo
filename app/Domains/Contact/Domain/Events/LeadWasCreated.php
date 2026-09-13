<?php

declare(strict_types=1);

namespace App\Domains\Contact\Domain\Events;

use DateTimeImmutable;

final readonly class LeadWasCreated
{
    public function __construct(
        public string $aggregateId,
        public DateTimeImmutable $occurredAt = new DateTimeImmutable(),
        // TODO: add any other data this event's listeners need.
    ) {}
}

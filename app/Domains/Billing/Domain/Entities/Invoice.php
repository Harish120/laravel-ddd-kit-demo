<?php

declare(strict_types=1);

namespace App\Domains\Billing\Domain\Entities;

use Harryes\LaravelDddKit\Domain\AggregateRoot;

final class Invoice extends AggregateRoot
{
    private const STATUS_PENDING = 'pending';

    private const STATUS_PAID = 'paid';

    private function __construct(
        private readonly string $id,
        private readonly string $leadId,
        private readonly int $amountCents,
        private string $status,
    ) {}

    /**
     * Records a new Invoice as a fact. Use this when the aggregate is
     * being created for the first time — never when loading from storage.
     */
    public static function create(string $id, string $leadId, int $amountCents): self
    {
        return new self($id, $leadId, $amountCents, self::STATUS_PENDING);
    }

    /**
     * Rehydrates an Invoice from persistence. Records no events —
     * this is not a new fact, just loading existing state.
     */
    public static function reconstitute(string $id, string $leadId, int $amountCents, string $status): self
    {
        return new self($id, $leadId, $amountCents, $status);
    }

    public function id(): string
    {
        return $this->id;
    }

    public function leadId(): string
    {
        return $this->leadId;
    }

    public function amountCents(): int
    {
        return $this->amountCents;
    }

    public function status(): string
    {
        return $this->status;
    }

    public function markPaid(): void
    {
        $this->status = self::STATUS_PAID;
    }
}

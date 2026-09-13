<?php

declare(strict_types=1);

namespace App\Domains\Contact\Domain\Entities;

use App\Domains\Contact\Domain\Events\LeadWasCreated;
use App\Domains\Contact\Domain\ValueObjects\Email;
use Harryes\LaravelDddKit\Domain\AggregateRoot;

final class Lead extends AggregateRoot
{
    private function __construct(
        private readonly string $id,
        private readonly Email $email,
    ) {}

    /**
     * Records a new Lead as a fact. Use this when the aggregate is
     * being created for the first time — never when loading from storage.
     */
    public static function create(string $id, Email $email): self
    {
        $aggregate = new self($id, $email);

        $aggregate->record(new LeadWasCreated($id));

        return $aggregate;
    }

    /**
     * Rehydrates a Lead from persistence. Records no events —
     * this is not a new fact, just loading existing state.
     */
    public static function reconstitute(string $id, Email $email): self
    {
        return new self($id, $email);
    }

    public function id(): string
    {
        return $this->id;
    }

    public function email(): Email
    {
        return $this->email;
    }
}

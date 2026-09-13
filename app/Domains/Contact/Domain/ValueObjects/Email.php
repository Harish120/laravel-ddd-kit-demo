<?php

declare(strict_types=1);

namespace App\Domains\Contact\Domain\ValueObjects;

use App\Domains\Contact\Domain\Exceptions\InvalidEmail;

final readonly class Email
{
    public function __construct(
        private string $value,
    ) {
        if (filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
            throw InvalidEmail::forValue($value);
        }
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}

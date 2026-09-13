<?php

declare(strict_types=1);

namespace App\Domains\Contact\Application\DTOs;

final readonly class CreateLeadData
{
    public function __construct(
        public string $email,
    ) {}
}

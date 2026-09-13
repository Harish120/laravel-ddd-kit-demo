<?php

declare(strict_types=1);

namespace App\Domains\Contact\Domain\Repositories;

use App\Domains\Contact\Domain\Entities\Lead;

interface LeadRepository
{
    public function find(string $id): ?Lead;

    public function save(Lead $lead): void;
}

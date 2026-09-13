<?php

declare(strict_types=1);

namespace App\Domains\Contact\Infrastructure\Persistence\Repositories;

use App\Domains\Contact\Domain\Entities\Lead;
use App\Domains\Contact\Domain\Repositories\LeadRepository;
use App\Domains\Contact\Domain\ValueObjects\Email;
use App\Domains\Contact\Infrastructure\Persistence\Eloquent\LeadModel;

final class EloquentLeadRepository implements LeadRepository
{
    public function find(string $id): ?Lead
    {
        $model = LeadModel::find($id);

        if ($model === null) {
            return null;
        }

        return Lead::reconstitute($model->getKey(), new Email($model->email));
    }

    public function save(Lead $lead): void
    {
        LeadModel::query()->updateOrCreate(
            ['id' => $lead->id()],
            ['email' => $lead->email()->value()],
        );
    }
}

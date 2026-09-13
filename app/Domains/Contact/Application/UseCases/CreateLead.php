<?php

declare(strict_types=1);

namespace App\Domains\Contact\Application\UseCases;

use App\Domains\Contact\Application\DTOs\CreateLeadData;
use App\Domains\Contact\Domain\Entities\Lead;
use App\Domains\Contact\Domain\Repositories\LeadRepository;
use App\Domains\Contact\Domain\ValueObjects\Email;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;

final class CreateLead
{
    public function __construct(
        private readonly LeadRepository $leads,
    ) {}

    public function handle(CreateLeadData $data): void
    {
        $aggregate = DB::transaction(function () use ($data): Lead {
            $aggregate = Lead::create(Str::uuid()->toString(), new Email($data->email));

            $this->leads->save($aggregate);

            return $aggregate;
        });

        foreach ($aggregate->pullDomainEvents() as $event) {
            Event::dispatch($event);
        }
    }
}

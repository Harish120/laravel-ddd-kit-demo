<?php

declare(strict_types=1);

use App\Domains\Contact\Application\DTOs\CreateLeadData;
use App\Domains\Contact\Application\UseCases\CreateLead;
use App\Domains\Contact\Domain\Entities\Lead;
use App\Domains\Contact\Domain\Repositories\LeadRepository;
use Illuminate\Support\Facades\Event;

final class InMemoryLeadRepository implements LeadRepository
{
    /** @var array<string, Lead> */
    public array $saved = [];

    public function find(string $id): ?Lead
    {
        return $this->saved[$id] ?? null;
    }

    public function save(Lead $lead): void
    {
        $this->saved[$lead->id()] = $lead;
    }
}

it('saves a new Lead and dispatches LeadWasCreated after the transaction', function (): void {
    Event::fake();

    $repository = new InMemoryLeadRepository();
    $useCase = new CreateLead($repository);

    $useCase->handle(new CreateLeadData(email: 'lead@example.com'));

    expect($repository->saved)->toHaveCount(1);

    $lead = array_values($repository->saved)[0];
    expect($lead->email()->value())->toBe('lead@example.com');

    Event::assertDispatched(App\Domains\Contact\Domain\Events\LeadWasCreated::class);
});

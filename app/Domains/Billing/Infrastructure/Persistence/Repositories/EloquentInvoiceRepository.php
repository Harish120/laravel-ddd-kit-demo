<?php

declare(strict_types=1);

namespace App\Domains\Billing\Infrastructure\Persistence\Repositories;

use App\Domains\Billing\Domain\Entities\Invoice;
use App\Domains\Billing\Domain\Repositories\InvoiceRepository;
use App\Domains\Billing\Infrastructure\Persistence\Eloquent\InvoiceModel;

final class EloquentInvoiceRepository implements InvoiceRepository
{
    public function find(string $id): ?Invoice
    {
        $model = InvoiceModel::find($id);

        if ($model === null) {
            return null;
        }

        return Invoice::reconstitute($model->getKey(), $model->lead_id, $model->amount_cents, $model->status);
    }

    public function save(Invoice $invoice): void
    {
        InvoiceModel::query()->updateOrCreate(
            ['id' => $invoice->id()],
            [
                'lead_id' => $invoice->leadId(),
                'amount_cents' => $invoice->amountCents(),
                'status' => $invoice->status(),
            ],
        );
    }
}

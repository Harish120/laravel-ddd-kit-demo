<?php

declare(strict_types=1);

namespace App\Domains\Billing\Application\Queries;

use Illuminate\Support\Facades\DB;

final readonly class ListInvoices
{
    public function handle(): mixed
    {
        return DB::table('invoices')
            ->join('leads', 'leads.id', '=', 'invoices.lead_id')
            ->select('invoices.*', 'leads.email as lead_email')
            ->orderByDesc('invoices.created_at')
            ->get();
    }
}

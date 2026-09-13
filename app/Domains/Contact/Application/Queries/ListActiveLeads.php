<?php

declare(strict_types=1);

namespace App\Domains\Contact\Application\Queries;

use Illuminate\Support\Facades\DB;

final readonly class ListActiveLeads
{
    public function handle(): mixed
    {
        return DB::table('leads')->orderByDesc('created_at')->get();
    }
}

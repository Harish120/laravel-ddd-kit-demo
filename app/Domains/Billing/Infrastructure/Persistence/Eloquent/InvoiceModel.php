<?php

declare(strict_types=1);

namespace App\Domains\Billing\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;

/**
 * @internal Infrastructure-only persistence model — never exposed outside Infrastructure/.
 */
final class InvoiceModel extends Model
{
    protected $table = 'invoices';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = ['id', 'lead_id', 'amount_cents', 'status'];
}

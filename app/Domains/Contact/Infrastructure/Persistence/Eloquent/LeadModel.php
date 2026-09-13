<?php

declare(strict_types=1);

namespace App\Domains\Contact\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;

/**
 * @internal Infrastructure-only persistence model — never exposed outside Infrastructure/.
 */
final class LeadModel extends Model
{
    protected $table = 'leads';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = ['id', 'email'];
}

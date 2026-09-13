<?php

declare(strict_types=1);

namespace App\Domains\Billing\Infrastructure\Http\Controllers;

use App\Domains\Billing\Application\Queries\ListInvoices;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

final class InvoiceController extends Controller
{
    public function index(ListInvoices $query): View
    {
        return view('billing.invoices.index', [
            'invoices' => $query->handle(),
        ]);
    }
}

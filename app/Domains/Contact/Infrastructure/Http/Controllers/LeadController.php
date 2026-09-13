<?php

declare(strict_types=1);

namespace App\Domains\Contact\Infrastructure\Http\Controllers;

use App\Domains\Contact\Application\DTOs\CreateLeadData;
use App\Domains\Contact\Application\Queries\ListActiveLeads;
use App\Domains\Contact\Application\UseCases\CreateLead;
use App\Domains\Contact\Domain\Exceptions\InvalidEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

final class LeadController extends Controller
{
    public function index(ListActiveLeads $query): View
    {
        return view('contact.leads.index', [
            'leads' => $query->handle(),
        ]);
    }

    public function store(Request $request, CreateLead $useCase): RedirectResponse
    {
        try {
            $useCase->handle(new CreateLeadData(email: (string) $request->input('email')));
        } catch (InvalidEmail $e) {
            return back()->withErrors(['email' => $e->getMessage()])->withInput();
        }

        return redirect()->route('contact.leads.index')->with('status', 'Lead created.');
    }
}

<?php

declare(strict_types=1);

use Illuminate\Support\Facades\DB;

it('automatically creates a pending invoice when a lead is created', function (): void {
    $this->post(route('contact.leads.store'), ['email' => 'lead@example.com'])
        ->assertRedirect(route('contact.leads.index'));

    $lead = DB::table('leads')->where('email', 'lead@example.com')->first();

    expect($lead)->not->toBeNull();

    $invoice = DB::table('invoices')->where('lead_id', $lead->id)->first();

    expect($invoice)->not->toBeNull()
        ->and($invoice->status)->toBe('pending')
        ->and($invoice->amount_cents)->toBe(5000);
});

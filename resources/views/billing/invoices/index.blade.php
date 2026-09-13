@extends('layouts.app')

@section('title', 'Billing · Invoices')

@section('content')
    <h1 class="text-xl font-semibold mb-1">Billing domain — Invoices</h1>
    <p class="text-slate-500 text-sm mb-6">
        Every row here was created by
        <code class="bg-slate-100 px-1 rounded">CreateInvoiceOnLeadWasCreated</code>,
        a listener reacting to Contact's <code class="bg-slate-100 px-1 rounded">LeadWasCreated</code> event —
        nothing on this page was created directly.
    </p>

    <div class="bg-white rounded-lg border border-slate-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-500 text-left">
                <tr>
                    <th class="px-4 py-2 font-medium">Lead</th>
                    <th class="px-4 py-2 font-medium">Amount</th>
                    <th class="px-4 py-2 font-medium">Status</th>
                    <th class="px-4 py-2 font-medium">Created</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($invoices as $invoice)
                    <tr>
                        <td class="px-4 py-3">{{ $invoice->lead_email }}</td>
                        <td class="px-4 py-3">${{ number_format($invoice->amount_cents / 100, 2) }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-block rounded-full px-2 py-0.5 text-xs
                                {{ $invoice->status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                                {{ $invoice->status }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-slate-400">{{ $invoice->created_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-slate-400">
                            No invoices yet — create a lead first.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Contact · Leads')

@section('content')
    <h1 class="text-xl font-semibold mb-1">Contact domain — Leads</h1>
    <p class="text-slate-500 text-sm mb-6">
        Creating a lead here dispatches <code class="bg-slate-100 px-1 rounded">LeadWasCreated</code>,
        which the Billing domain reacts to — check the
        <a href="{{ route('billing.invoices.index') }}" class="text-indigo-600 underline">Invoices</a> page after submitting.
    </p>

    <form method="POST" action="{{ route('contact.leads.store') }}" class="flex gap-2 mb-8">
        @csrf
        <input
            type="email"
            name="email"
            placeholder="lead@example.com"
            value="{{ old('email') }}"
            required
            class="flex-1 rounded-md border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('email') border-red-400 @enderror"
        >
        <button type="submit" class="rounded-md bg-slate-900 text-white px-4 py-2 text-sm hover:bg-slate-700">
            Create Lead
        </button>
    </form>

    @error('email')
        <p class="text-red-600 text-sm -mt-6 mb-6">{{ $message }}</p>
    @enderror

    <div class="bg-white rounded-lg border border-slate-200 divide-y divide-slate-100">
        @forelse ($leads as $lead)
            <div class="px-4 py-3 flex items-center justify-between text-sm">
                <span class="font-medium">{{ $lead->email }}</span>
                <span class="text-slate-400">{{ $lead->created_at }}</span>
            </div>
        @empty
            <div class="px-4 py-6 text-center text-slate-400 text-sm">No leads yet.</div>
        @endforelse
    </div>
@endsection

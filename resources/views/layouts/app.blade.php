<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'DDD Kit Demo')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen">
    <nav class="bg-white border-b border-slate-200">
        <div class="max-w-4xl mx-auto px-6 py-4 flex items-center justify-between">
            <span class="font-semibold text-slate-800">laravel-ddd-kit demo</span>
            <div class="flex gap-6 text-sm">
                <a href="{{ route('contact.leads.index') }}"
                   class="hover:text-indigo-600 {{ request()->routeIs('contact.*') ? 'text-indigo-600 font-medium' : 'text-slate-600' }}">
                    Contact · Leads
                </a>
                <a href="{{ route('billing.invoices.index') }}"
                   class="hover:text-indigo-600 {{ request()->routeIs('billing.*') ? 'text-indigo-600 font-medium' : 'text-slate-600' }}">
                    Billing · Invoices
                </a>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-6 py-10">
        @if (session('status'))
            <div class="mb-6 rounded-md bg-green-50 border border-green-200 text-green-800 px-4 py-3 text-sm">
                {{ session('status') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>

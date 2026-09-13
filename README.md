# laravel-ddd-kit-demo

A working Laravel 13 app built with
[`harryes/laravel-ddd-kit`](https://github.com/Harish120/laravel-ddd-kit),
used to verify the package's scaffolding commands and demonstrate a real
cross-domain flow.

## What's here

Two bounded contexts, `Contact` and `Billing`, wired together entirely
through a domain event — `Billing` never touches `Contact`'s entities:

- **`Contact`** — a `Lead` aggregate root, an `Email` value object with real
  validation, a `CreateLead` use case (the transaction boundary), and a
  `LeadWasCreated` domain event.
- **`Billing`** — an `Invoice` aggregate, and a `CreateInvoiceOnLeadWasCreated`
  listener that reacts to `Contact`'s event by creating a pending invoice —
  the one thing that crosses the boundary is the event itself.
- A small Tailwind-styled frontend: create a lead at `/contact/leads`, then
  watch the auto-generated invoice show up at `/billing/invoices`.
- 16 Pest tests: unit tests for the aggregates/value objects, use case tests
  against in-memory repository fakes, and one feature test asserting the full
  HTTP → event → listener → persistence chain.

See `app/Domains/Contact` and `app/Domains/Billing` for the generated
structure, and [`SESSION_OVERVIEW.md`](SESSION_OVERVIEW.md) for background on
how the package itself was built.

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

Then visit `http://127.0.0.1:8000/contact/leads`.

## Verifying the DDD discipline

```bash
php artisan ddd:doctor   # statically checks the non-negotiables still hold
vendor/bin/pest          # runs the full test suite
```

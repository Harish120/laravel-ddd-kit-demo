# Session overview — harryes/laravel-ddd-kit

Reference notes from the chat session that built this package, for use while
this demo app and the `laravel-ddd-kit` package are open side by side.

## What this package is

`harryes/laravel-ddd-kit` scaffolds a real Domain-Driven Design architecture
into a Laravel app via `ddd:*` artisan commands — Domain/Application/
Infrastructure layers, aggregate roots, value objects, domain events — with
`ddd:doctor` statically checking that the DDD discipline holds even after
hand-edits. Full command reference and a verified Quick Start walkthrough
live in the package's own `README.md`.

## What got built, in order

1. **Package skeleton** — `composer.json`, `DddKitServiceProvider`, `config/ddd.php`.
2. **Core commands** (in build order): `ddd:domain`, `ddd:entity [--aggregate]`,
   `ddd:value-object`, `ddd:usecase`, `ddd:repository`, `ddd:event` +
   `ddd:listener [--event=domain/event]`, `ddd:query`, `ddd:doctor`.
3. **Differentiators**: `ddd:domain --interactive` (via `laravel/prompts`),
   auto `composer dump-autoload` after scaffolding, and a companion Pest test
   generated alongside every `ddd:entity`/`ddd:value-object`/`ddd:usecase`.
4. **Dogfooding pass** — built a real Laravel 13 app (this demo's predecessor)
   and ran every command against it for real. Found and fixed one bug: a
   redundant `.gitkeep` written into `Infrastructure/Providers/` even though
   that directory always gets a real `ServiceProvider` file in the same run.
5. **PHPStan raised from level 6 to `max`** (level 9) — fixed all 64 resulting
   errors by narrowing every `config()`/`Command::argument()`/`option()` read
   (all natively `mixed`) through two small helpers instead of unchecked
   casts: `Harryes\LaravelDddKit\Support\Config` and the
   `Console\Concerns\ReadsTypedInput` trait.
6. **README overhaul** — badges, a table of contents, anchors on every
   section, and a Quick Start that was actually run end-to-end to verify it
   works (the first draft had a bug — a listener step referenced a `Billing`
   domain that was never scaffolded — caught before it shipped).
7. **Published**: repo made public, tagged `v0.1.0`, submitted to Packagist,
   GitHub webhook confirmed active (auto-syncs on push), and verified with a
   real `composer require harryes/laravel-ddd-kit` from a clean scratch app —
   no path repo, no `@dev` — which is exactly what this demo app repeats.

## Current state (as of this session)

- **Repo**: public — https://github.com/Harish120/laravel-ddd-kit
- **Packagist**: https://packagist.org/packages/harryes/laravel-ddd-kit —
  `v0.1.0` indexed, webhook active
- **Tests**: 71 passing (Pest)
- **Static analysis**: PHPStan level `max`, clean
- **Style**: Pint, clean
- **CI**: GitHub Actions (`lint`, `static-analysis`, `test` on PHP 8.3 + 8.4),
  green

## Conventions used throughout (worth keeping consistent)

- **Commits**: gitmoji + conventional-commit style (`✨ feat:`, `🐛 fix:`,
  `📝 docs:`, `✅ test:`, `🔧 chore:`), one logical change per commit,
  **no co-author trailer** — commits are attributed solely to the repo owner.
- **Every change** gets Pint + PHPStan (`max`) + Pest green before committing.
- Config values needing test isolation (paths, feature toggles) go through
  `config/ddd.php` with a documented default, never hardcoded — several exist
  specifically so the package's own test suite doesn't write into or shell
  out against `vendor/orchestra/testbench-core` during tests.

## Known, deliberate deviations from the original spec (flagged, not hidden)

- `AggregateRoot` base class lives in the package itself
  (`Harryes\LaravelDddKit\Domain\AggregateRoot`) since the spec didn't say
  where the "base class" domain events record to should live.
- `Application/Listeners/` is a folder not in the original documented shape —
  added on demand by `ddd:listener`, since cross-domain listener placement
  wasn't specified either.
- `laravel-ddd-package-prompt.md` (the internal project brief) was removed
  from the repo going forward (gitignored) after being flagged confidential —
  it still exists in git history at commit `ae1163c` and inside the already-
  published `v0.1.0` tag, since purging it would require a history rewrite
  and force-push that breaks Packagist's already-fetched tag.

## How to use this demo app

This folder is intentionally empty — install it yourself:

```bash
composer create-project laravel/laravel:^13.0 .
composer require harryes/laravel-ddd-kit
php artisan ddd:domain Contact
php artisan ddd:entity Contact/Lead --aggregate
php artisan ddd:doctor
```

That's the same sequence already verified working against a real, clean
Packagist install in this session. See the package README's "Quick start"
section for the fuller two-domain walkthrough (including a cross-domain
listener), and "Companion Pest tests" for the note about needing Pest
installed separately if you want the generated test files to actually run.

## What's next (not done yet)

- Social/community announcement (r/laravel, Laravel Discord, dev.to,
  `awesome-laravel` submission) — package is verified ready for this.
- Optional: a demo GIF/asciinema recording embedded in the README — flagged
  as the single highest-leverage remaining item, not yet created.
- Optional: a custom GitHub social preview image (Settings → General →
  Social preview) for nicer link-share cards.

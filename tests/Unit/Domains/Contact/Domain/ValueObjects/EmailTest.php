<?php

declare(strict_types=1);

use App\Domains\Contact\Domain\Exceptions\InvalidEmail;
use App\Domains\Contact\Domain\ValueObjects\Email;

it('is equal to another instance with the same value', function (): void {
    $a = new Email('lead@example.com');
    $b = new Email('lead@example.com');

    expect($a->equals($b))->toBeTrue();
});

it('is not equal to an instance with a different value', function (): void {
    $a = new Email('lead@example.com');
    $b = new Email('someone-else@example.com');

    expect($a->equals($b))->toBeFalse();
});

it('casts to its underlying value as a string', function (): void {
    $value = new Email('lead@example.com');

    expect((string) $value)->toBe('lead@example.com');
});

it('rejects a malformed email address', function (): void {
    new Email('not-an-email');
})->throws(InvalidEmail::class);

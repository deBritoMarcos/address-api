<?php

declare(strict_types=1);

use App\Repositories\Address\Contracts\AddressEloquentRepositoryInterface;

it('must have a contract for the repository', function () {
    expect(app()->bound(AddressEloquentRepositoryInterface::class))
        ->toBeTrue();
});

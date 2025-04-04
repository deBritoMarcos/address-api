<?php

declare(strict_types=1);

use App\Models\Address;
use App\Repositories\Address\AddressEloquentRepository;

beforeEach(function () {
    $this->repository = new AddressEloquentRepository(new Address());
});

test('`findBy` returns nothing when not found the zip code', function () {
    $returnedAddress = $this->repository
        ->findBy('zip_code', 96010330);

    expect($returnedAddress)
        ->toBeEmpty();
});

test('`findBy` returns expected address when exists', function () {
    $expectedAddress = Address::factory()
        ->create();

    $returnedAddress = $this->repository
        ->findBy('zip_code', $expectedAddress->zip_code);

    expect($returnedAddress)
        ->zip_code->toBe($expectedAddress->zip_code)
        ->address->toBe($expectedAddress->address)
        ->complement->toBe($expectedAddress->complement)
        ->district->toBe($expectedAddress->district)
        ->city->toBe($expectedAddress->city)
        ->uf->toBe($expectedAddress->uf);
});

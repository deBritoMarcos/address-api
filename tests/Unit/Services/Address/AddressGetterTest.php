<?php

declare(strict_types=1);

use App\Integrations\ViaCep\DTO\Address\AddressHttpOutputData;
use App\Integrations\ViaCep\Repositories\Address\Contracts\AddressHttpRepositoryInterface;
use App\Models\Address;
use App\Repositories\Address\AddressEloquentRepository;
use App\Services\Address\Contracts\AddressGetterInterface;
use Illuminate\Database\Eloquent\Casts\Json;

it('must have a contract for the repository', function () {
    expect(app()->bound(AddressGetterInterface::class))
        ->toBeTrue();
});

test('`findByZipCode` returns expected address data from database when found', function () {
    $expectedAddress = Address::factory()
        ->create();

    $addressEloquentRepositoryMock = mock(AddressEloquentRepository::class)
        ->shouldReceive('findBy')
        ->with($expectedAddress->zip_code)
        ->andReturn($expectedAddress)
        ->getMock();

    $this->instance(AddressEloquentRepository::class, $addressEloquentRepositoryMock);

    $addressHttpRepositoryMock = mock(AddressHttpRepositoryInterface::class)
        ->shouldNotReceive('find')
        ->getMock();

    $this->instance(AddressHttpRepositoryInterface::class, $addressHttpRepositoryMock);

    $address = app()->make(AddressGetterInterface::class)
        ->findByZipCode($expectedAddress->zip_code);

    expect($address)
        ->zipCode->toBe($expectedAddress->zip_code)
        ->address->toBe($expectedAddress->address)
        ->complement->toBe($expectedAddress->complement)
        ->district->toBe($expectedAddress->district)
        ->city->toBe($expectedAddress->city)
        ->uf->toBe($expectedAddress->uf);
});

test('`findByZipCode` when address not found in the database must get from Via Cep', function () {
    $cep = '96010450';

    $addressEloquentRepositoryMock = mock(AddressEloquentRepository::class)
        ->shouldReceive('findBy')
        ->with($cep)
        ->andReturnNull()
        ->getMock();

    $this->instance(AddressEloquentRepository::class, $addressEloquentRepositoryMock);

    $addressHttpOutputData = AddressHttpOutputData::fromJson(
        Json::encode(dataset_get('data.integrations.via-cep.address-http.output'))
    );

    $addressHttpRepositoryMock = mock(AddressHttpRepositoryInterface::class)
        ->shouldReceive('find')
        ->with($cep)
        ->andReturn($addressHttpOutputData)
        ->getMock();

    $this->instance(AddressHttpRepositoryInterface::class, $addressHttpRepositoryMock);

    $address = app()->make(AddressGetterInterface::class)
        ->findByZipCode($cep);

    expect($address)
        ->zipCode->toBe('99010220')
        ->address->toBe('::logradouro::')
        ->complement->toBe('::complemento::')
        ->district->toBe('::bairro::')
        ->city->toBe('::localidade::')
        ->uf->toBe('::uf::');
});

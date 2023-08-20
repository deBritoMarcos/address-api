<?php

declare(strict_types=1);

use App\Integrations\ViaCep\DTO\Address\AddressHttpOutputData;
use App\Integrations\ViaCep\Repositories\Address\AddressHttpRepository;
use App\Integrations\ViaCep\Repositories\Address\Contracts\AddressHttpRepositoryInterface;
use App\Services\Address\AddressFinder;
use Illuminate\Database\Eloquent\Casts\Json;

it('finds an address by zip code', function () {
    $cep = '96010450';
    $addressHttpOutputData = AddressHttpOutputData::fromJson(
        Json::encode(dataset_get('data.integrations.via-cep.address-http.output'))
    );

    $repositoryMock = mock(AddressHttpRepository::class)
        ->shouldReceive('findByCep')
        ->with($cep)
        ->andReturn($addressHttpOutputData)
        ->getMock();

    $this->instance(AddressHttpRepositoryInterface::class, $repositoryMock);

    $address = app()->make(AddressFinder::class)
        ->find($cep);

    expect($address)
        ->zipCode->toBe('::cep::')
        ->address->toBe('::logradouro::')
        ->complement->toBe('::complemento::')
        ->district->toBe('::bairro::')
        ->place->toBe('::localidade::')
        ->uf->toBe('::uf::');
});

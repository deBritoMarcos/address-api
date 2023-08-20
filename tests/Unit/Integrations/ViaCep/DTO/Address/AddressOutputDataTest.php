<?php

declare(strict_types=1);

use App\Integrations\ViaCep\DTO\Address\AddressOutputData;

it('creates the output address data', function () {
    $addressOutput = dataset_get('data.integrations.via-cep.address.output');

    $addressDTO = new AddressOutputData(
        zipCode: $addressOutput['zip_code'],
        address: $addressOutput['address'],
        complement: $addressOutput['complement'],
        district: $addressOutput['district'],
        place: $addressOutput['place'],
        uf: $addressOutput['uf']
    );

    expect($addressDTO->toArray())
        ->toBe([
            'zip_code' => '::zip_code::',
            'address' => '::address::',
            'complement' => '::complement::',
            'district' => '::district::',
            'place' => '::place::',
            'uf' => '::uf::',
        ]);
});

it('creates the output address data from array', function () {
    $addressOutput = dataset_get('data.integrations.via-cep.address.output');

    $addressDTO = AddressOutputData::fromArray($addressOutput);

    expect($addressDTO->toArray())
        ->toBe([
            'zip_code' => '::zip_code::',
            'address' => '::address::',
            'complement' => '::complement::',
            'district' => '::district::',
            'place' => '::place::',
            'uf' => '::uf::',
        ]);
});

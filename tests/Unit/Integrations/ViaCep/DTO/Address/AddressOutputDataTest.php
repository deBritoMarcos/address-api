<?php

declare(strict_types=1);

use App\Integrations\ViaCep\DTO\Address\AddressHttpOutputData;
use App\Integrations\ViaCep\DTO\Address\AddressOutputData;

test('`fromArray` creates the output address data from array', function () {
    $addressOutput = dataset_get('data.integrations.via-cep.address.output');

    $addressDTO = AddressOutputData::fromArray($addressOutput);

    expect($addressDTO->toArray())
        ->toBe([
            'zip_code' => '99010220',
            'address' => '::address::',
            'complement' => '::complement::',
            'district' => '::district::',
            'city' => '::city::',
            'uf' => '::uf::',
        ]);
});

test('`fromViaCep` creates the output address data from Via Cep DTO', function () {
    $addressHttpDto = AddressHttpOutputData::fromJson(
        json_encode(dataset_get('data.integrations.via-cep.address-http.output'))
    );

    $addressDTO = AddressOutputData::fromViaCep($addressHttpDto);

    expect($addressDTO->toArray())
        ->toBe([
            'zip_code' => '99010220',
            'address' => '::logradouro::',
            'complement' => '::complemento::',
            'district' => '::bairro::',
            'city' => '::localidade::',
            'uf' => '::uf::',
        ]);
});

<?php

declare(strict_types=1);

use App\Integrations\ViaCep\DTO\Address\AddressHttpOutputData;
use Illuminate\Database\Eloquent\Casts\Json;

it('creates the http output address data', function () {
    $addressHttpOutput = dataset_get('data.integrations.via-cep.address-http.output');

    $addressDTO = new AddressHttpOutputData(
        zipCode: $addressHttpOutput['cep'],
        address: $addressHttpOutput['logradouro'],
        complement: $addressHttpOutput['complemento'],
        district: $addressHttpOutput['bairro'],
        city: $addressHttpOutput['localidade'],
        uf: $addressHttpOutput['uf'],
        ibge: $addressHttpOutput['ibge'],
        gia: $addressHttpOutput['gia'],
        ddd: $addressHttpOutput['ddd'],
        siafi: $addressHttpOutput['siafi'],
    );

    expect($addressDTO->toArray())
        ->toBe([
            'zip_code' => '99010-220',
            'address' => '::logradouro::',
            'complement' => '::complemento::',
            'district' => '::bairro::',
            'city' => '::localidade::',
            'uf' => '::uf::',
            'ibge' => '::ibge::',
            'gia' => '::gia::',
            'ddd' => '::ddd::',
            'siafi' => '::siafi::',
        ]);
})->only();

it('creates the http output address data from json payload', function () {
    $addressHttpOutput = Json::encode(dataset_get('data.integrations.via-cep.address-http.output'));

    $addressDTO = AddressHttpOutputData::fromJson($addressHttpOutput);

    expect($addressDTO->toArray())
        ->toBe([
            'zip_code' => '99010220',
            'address' => '::logradouro::',
            'complement' => '::complemento::',
            'district' => '::bairro::',
            'city' => '::localidade::',
            'uf' => '::uf::',
            'ibge' => '::ibge::',
            'gia' => '::gia::',
            'ddd' => '::ddd::',
            'siafi' => '::siafi::',
        ]);
});

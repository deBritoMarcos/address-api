<?php

declare(strict_types=1);

use App\Integrations\ViaCep\DTO\Address\AddressOutputData;
use App\Services\Address\Contracts\AddressGetterInterface;
use Illuminate\Http\Response;

it('returns `Unprocessable Entity status code` when a invalid param is given', function (mixed $zipCode) {
    $this->mock(AddressGetterInterface::class)
        ->shouldNotReceive('findByZipCode')
        ->getMock();

    $this->get("api/address/{$zipCode}")
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson(['error' => ['The zip code provided is invalid, check the number of digits provided']]);
})
    ->with([
        'parameter with size less than 8' => '96010--450',
        'parameter with size greater than 9' => '9601045',
    ]);

it('returns `Ok status code` when returned expected address with successfully', function () {
    $this->mock(AddressGetterInterface::class)
        ->shouldReceive('findByZipCode')
        ->with('96010450')
        ->andReturn(
            AddressOutputData::fromArray(dataset_get('data.integrations.via-cep.address.output'))
        )
        ->getMock();

    $this->get('api/address/96010450')
        ->assertStatus(Response::HTTP_OK);
});

it('expects resource output', function () {
    $this->mock(AddressGetterInterface::class)
        ->shouldReceive('findByZipCode')
        ->with('96010450')
        ->andReturn(
            AddressOutputData::fromArray(dataset_get('data.integrations.via-cep.address.output'))
        )
        ->getMock();

    $response = $this->get('api/address/96010450');

    $outputAddress = json_decode($response->getContent(), true);

    expect($outputAddress['data'])
        ->toMatchArray([
            'zip_code' => '99010220',
            'address' => '::address::',
            'complement' => '::complement::',
            'district' => '::district::',
            'city' => '::city::',
            'uf' => '::uf::'
        ]);
});

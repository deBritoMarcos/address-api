<?php

declare(strict_types=1);

namespace App\Integrations\ViaCep\DTO\Address;

use Illuminate\Database\Eloquent\Casts\Json;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapOutputName(SnakeCaseMapper::class)]
class AddressHttpOutputData extends Data
{
    public function __construct(
        public string $zipCode,
        public ?string $address,
        public ?string $complement,
        public ?string $district,
        public ?string $place,
        public ?string $uf,
        public ?string $ibge,
        public ?string $gia,
        public ?string $ddd,
        public ?string $siafi,
    ) {
    }

    public static function fromJson(string $address): self
    {
        $addressFormatted = Json::decode($address);

        return new self(
            zipCode: $addressFormatted['cep'],
            address: $addressFormatted['logradouro'],
            complement: $addressFormatted['complemento'],
            district: $addressFormatted['bairro'],
            place: $addressFormatted['localidade'],
            uf: $addressFormatted['uf'],
            ibge: $addressFormatted['ibge'],
            gia: $addressFormatted['gia'],
            ddd: $addressFormatted['ddd'],
            siafi: $addressFormatted['siafi'],
        );
    }
}

<?php

declare(strict_types=1);

namespace App\Integrations\ViaCep\DTO\Address;

use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapOutputName(SnakeCaseMapper::class)]
class AddressOutputData extends Data
{
    public function __construct(
        public string $zipCode,
        public ?string $address,
        public ?string $complement,
        public ?string $district,
        public ?string $city,
        public ?string $uf,
    ) {
    }

    public static function fromArray(array $address): self
    {
        return new self(
            zipCode: $address['zip_code'],
            address: $address['address'],
            complement: $address['complement'],
            district: $address['district'],
            city: $address['city'],
            uf: $address['uf'],
        );
    }

    public static function fromViaCep(AddressHttpOutputData $address): self
    {
        return new self(
            zipCode: $address->zipCode,
            address: $address->address,
            complement: $address->complement,
            district: $address->district,
            city: $address->city,
            uf: $address->uf,
        );
    }
}

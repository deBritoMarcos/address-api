<?php

declare(strict_types=1);

namespace App\Integrations\ViaCep\DTO\Address;

use Spatie\LaravelData\Data;

class AddressData extends Data
{
    public function __construct(
        public string $zipCode,
        public ?string $address,
        public ?string $complement,
        public ?string $district,
        public ?string $place,
        public ?string $uf,
    ) {
    }

    public static function fromHttpData(AddressHttpOutputData $address): self
    {
        return new self(
            zipCode: $address->zipCode,
            address: $address->address,
            complement: $address->complement,
            district: $address->district,
            place: $address->place,
            uf: $address->uf,
        );
    }
}

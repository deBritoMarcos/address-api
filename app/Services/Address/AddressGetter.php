<?php

declare(strict_types=1);

namespace App\Services\Address;

use App\Integrations\ViaCep\DTO\Address\AddressOutputData;
use App\Integrations\ViaCep\Repositories\Address\Contracts\AddressHttpRepositoryInterface;
use App\Repositories\Address\Contracts\AddressEloquentRepositoryInterface;
use App\Services\Address\Contracts\AddressGetterInterface;

class AddressGetter implements AddressGetterInterface
{
    public function __construct(
        readonly private AddressHttpRepositoryInterface $addressHttpRepository,
        readonly private AddressEloquentRepositoryInterface $addressEloquentRepository,
    ) {
    }

    public function findByZipCode(string $zipCode): AddressOutputData
    {
        $address = $this->addressEloquentRepository->findBy('zip_code', $zipCode);

        if (! empty($address)) {
            return AddressOutputData::fromArray($address->toArray());
        }

        $address = $this->addressHttpRepository->find($zipCode);

        //CreateAddressJob::dispatch($zipCode, $address);

        return AddressOutputData::fromViaCep($address);
    }
}

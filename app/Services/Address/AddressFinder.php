<?php

declare(strict_types=1);

namespace App\Services\Address;

use App\Integrations\ViaCep\DTO\Address\AddressData;
use App\Integrations\ViaCep\Repositories\Address\Contracts\AddressHttpRepositoryInterface;
use App\Services\Address\Contracts\AddressFinderInterface;

class AddressFinder implements AddressFinderInterface
{
    public function __construct(
        readonly private AddressHttpRepositoryInterface $addressHttpRepository,
    ) {
    }

    public function find(string $parameter): AddressData
    {
        $address = $this->addressHttpRepository->findByCep($parameter);

        return AddressData::fromHttpData($address);
    }
}

<?php

declare(strict_types=1);

namespace App\Services\Address\Contracts;

use App\Integrations\ViaCep\DTO\Address\AddressOutputData;

interface AddressGetterInterface
{
    public function findByZipCode(string $zipCode): AddressOutputData;
}

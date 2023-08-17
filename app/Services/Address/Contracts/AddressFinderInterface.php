<?php

declare(strict_types=1);

namespace App\Services\Address\Contracts;

use App\Integrations\ViaCep\DTO\Address\AddressData;

interface AddressFinderInterface
{
    public function find(string $parameter): AddressData;
}

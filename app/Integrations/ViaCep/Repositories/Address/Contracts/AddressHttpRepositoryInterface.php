<?php

declare(strict_types=1);

namespace App\Integrations\ViaCep\Repositories\Address\Contracts;

use App\Integrations\ViaCep\DTO\Address\AddressHttpOutputData;

interface AddressHttpRepositoryInterface
{
    public function findByCep(string $zipCode): AddressHttpOutputData;
}

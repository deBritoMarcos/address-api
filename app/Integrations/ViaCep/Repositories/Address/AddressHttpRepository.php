<?php

declare(strict_types=1);

namespace App\Integrations\ViaCep\Repositories\Address;

use App\Integrations\ViaCep\DTO\Address\AddressHttpOutputData;
use App\Integrations\ViaCep\Repositories\Address\Contracts\AddressHttpRepositoryInterface;
use Illuminate\Http\Client\PendingRequest;

class AddressHttpRepository implements AddressHttpRepositoryInterface
{
    public function __construct(
        private readonly PendingRequest $http,
    ) {
    }

    public function findByCep(string $zipCode): AddressHttpOutputData
    {
        $response = $this->http
            ->get('https://viacep.com.br/ws/' . $zipCode . '/json');

        return AddressHttpOutputData::fromJson($response->body());
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Address;

use App\Http\Controllers\Controller;
use App\Http\Resources\Address\AddressResource;
use App\Services\Address\Contracts\AddressFinderInterface;
use Illuminate\Http\JsonResponse;

class Get extends Controller
{
    public function __construct(
        readonly private AddressFinderInterface $addressFinder,
    ) {
    }

    public function __invoke(string $data): JsonResponse
    {
        $address = $this->addressFinder->find($data);

        return (new AddressResource($address))
            ->response()
            ->setStatusCode(JsonResponse::HTTP_OK);
    }
}

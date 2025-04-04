<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Address;

use App\Http\Controllers\Controller;
use App\Http\Resources\Address\AddressResource;
use App\Services\Address\Contracts\AddressGetterInterface;
use Illuminate\Http\JsonResponse;

class ShowController extends Controller
{
    public function __construct(
        readonly private AddressGetterInterface $addressGetterService,
    ) {
    }

    public function __invoke(string $zipCode): JsonResponse
    {
        $address = $this->addressGetterService->findByZipCode($zipCode);

        return (new AddressResource($address))
            ->response()
            ->setStatusCode(JsonResponse::HTTP_OK);
    }
}

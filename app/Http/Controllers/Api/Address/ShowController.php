<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Address;

use App\Http\Controllers\Controller;
use App\Http\Resources\Address\AddressResource;
use App\Services\Address\Contracts\AddressGetterInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ShowController extends Controller
{
    public function __construct(
        readonly private AddressGetterInterface $addressGetterService,
    ) {
    }

    public function __invoke(string $zipCode): JsonResponse
    {
        $validator = Validator::make(['zipcode' => $zipCode], [
            'zipcode' => 'min:8|max:9'
        ], [
            'zipcode' => 'The zip code provided is invalid, check the number of digits provided'
        ]);

        if ($validator->fails()) {
            return response()->json(
                data: ['error' => $validator->errors()->all()],
                status: Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $address = $this->addressGetterService->findByZipCode($zipCode);

        return (new AddressResource($address))
            ->response()
            ->setStatusCode(JsonResponse::HTTP_OK);
    }
}

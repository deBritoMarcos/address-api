<?php

declare(strict_types=1);

namespace App\Http\Resources\Address;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'zip_code' => $this->zipCode,
            'address' => $this->address,
            'complement' => $this->complement,
            'district' => $this->district,
            'city' => $this->city,
            'uf' => $this->uf
        ];
    }
}

<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    public function definition(): array
    {
        $faker = fake('pt_BR');

        return [
            'zip_code' => (string) random_int(1111111, 9999999),
            'address' => $faker->streetName(),
            'complement' => $faker->words(2, true),
            'district' => $faker->country(),
            'city' => $faker->city(),
            'uf' => Str::upper(Str::random(2))
        ];
    }
}

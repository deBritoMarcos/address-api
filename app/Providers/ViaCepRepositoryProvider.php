<?php

declare(strict_types=1);

namespace App\Providers;

use App\Integrations\ViaCep\Repositories\Address\AddressHttpRepository;
use App\Integrations\ViaCep\Repositories\Address\Contracts\AddressHttpRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class ViaCepRepositoryProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            AddressHttpRepositoryInterface::class,
            AddressHttpRepository::class
        );
    }
}

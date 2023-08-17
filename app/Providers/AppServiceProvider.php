<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\Address\AddressFinder;
use App\Services\Address\Contracts\AddressFinderInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            AddressFinderInterface::class,
            AddressFinder::class
        );
    }

    public function boot(): void
    {
    }
}

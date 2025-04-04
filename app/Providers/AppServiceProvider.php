<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\Address\AddressGetter;
use App\Services\Address\Contracts\AddressGetterInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            AddressGetterInterface::class,
            AddressGetter::class
        );
    }

    public function boot(): void
    {
    }
}

<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Address;
use App\Repositories\Address\AddressEloquentRepository;
use App\Repositories\Address\Contracts\AddressEloquentRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class EloquentRepositoryProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            AddressEloquentRepositoryInterface::class,
            fn () => new AddressEloquentRepository(new Address())
        );
    }
}

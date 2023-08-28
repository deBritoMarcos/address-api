<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class HttpServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Http::macro('viaCep', function () {
            return Http::baseUrl(config('integrations.via-cep.base_url'))
                ->acceptJson()
                ->withUserAgent(config('app.name'));
        });
    }
}

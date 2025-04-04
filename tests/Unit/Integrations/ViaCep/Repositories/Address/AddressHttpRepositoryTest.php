<?php

declare(strict_types=1);

use App\Integrations\ViaCep\Repositories\Address\Contracts\AddressHttpRepositoryInterface;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\Response as ClientResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    $this->url = env('APP_URL') . '/test/viacep-test/';
    config()->set('integrations.via-cep.base_url', $this->url);

    $this->addressHttpOutput = dataset_get('data.integrations.via-cep.address-http.output');

    Http::preventStrayRequests();
});

it('sends with the expected zip code', function () {
    $http = Http::fake([
        route('http-test.viacep', ['96010330']) => Http::response(
            Json::encode($this->addressHttpOutput),
            Response::HTTP_OK
        )
    ]);

    app()->make(AddressHttpRepositoryInterface::class, [$http])
        ->find('96010330');

    Http::assertSent(function (Request $request) {
        return $request->url() === route('http-test.viacep', ['96010330'])
            && $request->method() === 'GET';
    });
});

it('returns address data', function () {
    $http = Http::fake([
        route('http-test.viacep', ['96010330']) => Http::response(
            Json::encode($this->addressHttpOutput),
            Response::HTTP_OK
        )
    ]);

    app()->make(AddressHttpRepositoryInterface::class, [$http])
        ->find('96010330');

    $recorded = Http::recorded(fn (Request $request, ClientResponse $response) => $response->successful());

    [$request, $response] = $recorded[0];
    expect($response->body())
        ->toBe(Json::encode($this->addressHttpOutput));
});

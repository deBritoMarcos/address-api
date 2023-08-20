<?php

declare(strict_types=1);

use Illuminate\Support\Arr;
use Pest\Repositories\DatasetsRepository;

function dataset_get(string $name): array
{
    return Arr::first(DatasetsRepository::resolve([$name], __FILE__));
}

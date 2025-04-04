<?php

declare(strict_types=1);

dataset('data.integrations.via-cep.address-http.output', [
    [
        'cep' => '99010-220',
        'logradouro' => '::logradouro::',
        'complemento' => '::complemento::',
        'bairro' => '::bairro::',
        'localidade' => '::localidade::',
        'uf' => '::uf::',
        'ibge' => '::ibge::',
        'gia' => '::gia::',
        'ddd' => '::ddd::',
        'siafi' => '::siafi::',
    ]
]);

dataset('data.integrations.via-cep.address.output', [
    [
        'zip_code' => '99010220',
        'address' => '::address::',
        'complement' => '::complement::',
        'district' => '::district::',
        'city' => '::city::',
        'uf' => '::uf::',
    ]
]);

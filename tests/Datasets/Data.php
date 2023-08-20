<?php

declare(strict_types=1);

dataset('data.integrations.via-cep.address-http.output', [
    [
        'cep' => '::cep::',
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
        'zip_code' => '::zip_code::',
        'address' => '::address::',
        'complement' => '::complement::',
        'district' => '::district::',
        'place' => '::place::',
        'uf' => '::uf::',
    ]
]);

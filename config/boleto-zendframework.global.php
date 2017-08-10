<?php

return [
    'boleto-zendframework' => [
        'beneficiario' => [
            'nome' => 'ACME',
            'endereco' => 'Rua um, 123',
            'cep' => '99999-999',
            'uf' => 'UF',
            'cidade' => 'CIDADE',
            'documento' => '99.999.999/9999-99',
        ],
        'dados-boleto' => [
            'logo' => '', // Logo da empresa
            'multa' => 10.00, // porcento
            'juros' => 2.00, // porcento ao mes
            'juros_apos' =>  1, // juros e multa após
            'diasProtesto' => false, // protestar após, se for necessário
            'agencia' => 9999, // BB, Bradesco, CEF, HSBC, Itáu
            'agenciaDv' => 9, // se possuir
            'conta' => 99999, // BB, Bradesco, CEF, HSBC, Itáu, Santander
            'contaDv' => 9, // Bradesco, HSBC, Itáu
            'carteira' => 'SR', // BB, Bradesco, CEF, HSBC, Itáu, Santander
            'convenio' => 9999999, // BB
            'variacaoCarteira' => 99, // BB
            'range' => 99999, // HSBC
            'ios' => 0, // Santander
            'descricaoDemonstrativo' => ['msg1', 'msg2', 'msg3'], // máximo de 5
            'instrucoes' =>  ['inst1', 'inst2'], // máximo de 5
            'aceite' => 1,
            'especieDoc' => 'DM',
        ]
    ]
];
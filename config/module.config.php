<?php

namespace BoletoZendFramework;

use BoletoZendFramework\Factory\BoletoFactory;

return [
    'service_manager' => [
        'factories' => [
            'boleto.zend.framework' => BoletoFactory::class
        ],
    ],
];
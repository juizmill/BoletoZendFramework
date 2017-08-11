<?php

namespace BoletoZendFramework;

use BoletoZendFramework\Factory\BoletoFactory;
use BoletoZendFramework\View\Render\PdfRendererFactory;
use BoletoZendFramework\View\Strategy\PdfStrategyFactory;

return [
    'service_manager' => [
        'factories' => [
            'ViewPdfStrategy' => PdfStrategyFactory::class,
            'ViewPdfRenderer' => PdfRendererFactory::class,
            'boleto.zend.framework' => BoletoFactory::class
        ],
    ],
];

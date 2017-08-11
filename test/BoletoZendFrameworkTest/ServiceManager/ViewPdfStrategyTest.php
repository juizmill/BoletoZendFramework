<?php

namespace ZendServiceTest\ServiceManager;

use BoletoZendFramework\View\Strategy\PdfStrategy;
use BoletoZendFrameworkTest\Framework\ServiceManager;
use BoletoZendFrameworkTest\Framework\TestCase;

class ViewPdfStrategyTest extends TestCase
{
    use ServiceManager;

    public function testVerificaSeServicoEstaProntoParaSerUsadoNoZend()
    {
        $pdfStrategy = $this->serviceManager()->get('ViewPdfStrategy');
        $this->assertInstanceOf(PdfStrategy::class, $pdfStrategy);
    }
}

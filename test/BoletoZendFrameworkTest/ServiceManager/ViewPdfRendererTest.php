<?php

namespace ZendServiceTest\ServiceManager;

use BoletoZendFramework\View\Render\PdfRender;
use BoletoZendFrameworkTest\Framework\ServiceManager;
use BoletoZendFrameworkTest\Framework\TestCase;

class ViewPdfRendererTest extends TestCase
{
    use ServiceManager;

    public function testVerificaSeServicoEstaProntoParaSerUsadoNoZend()
    {
        $viewPdfRenderer = $this->serviceManager()->get('ViewPdfRenderer');
        $this->assertInstanceOf(PdfRender::class, $viewPdfRenderer);
    }
}

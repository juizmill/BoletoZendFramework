<?php

namespace BoletoZendFrameworkTest\View\Render;

use BoletoZendFramework\View\Render\PdfRendererFactory;
use BoletoZendFramework\View\Render\PdfRender;
use BoletoZendFrameworkTest\Framework\TestCase;
use Zend\ServiceManager\Factory\FactoryInterface;

class PdfRenderFactoryTest extends TestCase
{
    public function testVerificaSeClasseImplementaFactoryInterface()
    {
        $this->assertInstanceOf(FactoryInterface::class, new PdfRendererFactory());
    }

    public function testRetornoDoMetodoInvoke()
    {
        $renderFactory = new PdfRendererFactory();
        $result = $renderFactory->__invoke($this->getServiceManager(), '');

        $this->assertInstanceOf(PdfRender::class, $result);
    }
}

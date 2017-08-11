<?php

namespace BoletoZendFrameworkTest\View\Render;

use Zend\View\Model\ModelInterface;
use Zend\View\Resolver\ResolverInterface;
use Zend\View\Renderer\RendererInterface;
use BoletoZendFramework\View\BoletoPdfModel;
use BoletoZendFramework\View\Render\PdfRender;
use BoletoZendFrameworkTest\Framework\TestCase;

class PdfRenderTest extends TestCase
{
    public function testVerificaSeClasseImplementaRendererInterface()
    {
        $this->assertInstanceOf(RendererInterface::class, new PdfRender());
    }

    public function testRetornoDoMetodoGetEngine()
    {
        $render = new PdfRender();
        $this->assertInstanceOf(PdfRender::class, $render->getEngine());
    }

    public function testRetornoDoMetodoSetResolver()
    {
        $resolveMock = $this->getMockBuilder(ResolverInterface::class)->getMock();

        $render = new PdfRender();
        $this->assertNull($render->setResolver($resolveMock));
    }

    public function testRetornoDoMetodoRender()
    {
        $modelMock = $this->getMockBuilder(BoletoPdfModel::class)->disableOriginalConstructor()->getMock();
        $modelMock->method('serialize')->willReturn([]);

        $render = new PdfRender();
        $this->assertTrue(is_array($render->render($modelMock)));
    }

    /**
     * @expectedException \Zend\View\Exception\DomainException
     */
    public function testVerificaSeRetornaExceptionNoMetodoSerialize()
    {
        $modelMock = $this->getMockBuilder(ModelInterface::class)->getMock();

        $render = new PdfRender();
        $render->render($modelMock);
    }
}

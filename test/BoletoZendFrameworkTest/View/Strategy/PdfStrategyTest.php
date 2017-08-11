<?php

namespace BoletoZendFrameworkTest\View\Strategy;

use Zend\Http\Headers;
use Zend\View\ViewEvent;
use Zend\Http\PhpEnvironment\Response;
use Zend\View\Renderer\RendererInterface;
use BoletoZendFramework\View\BoletoPdfModel;
use BoletoZendFrameworkTest\Framework\TestCase;
use Zend\EventManager\AbstractListenerAggregate;
use BoletoZendFramework\View\Strategy\PdfStrategy;
use Eduardokum\LaravelBoleto\Contracts\Boleto\Boleto;

class PdfStrategyTest extends TestCase
{
    public function testVerificaSeClasseExtendsDeAbstractListenerAggregate()
    {
        $this->assertInstanceOf(AbstractListenerAggregate::class, $this->strategyMock());
    }

    public function testRetornaNullCasoNaoSejaInstanciaDeBoletoPdfModel()
    {
        $eventMock = $this->viewEventMock();
        $eventMock->method('getModel')->willReturn(null);

        $strategy = new PdfStrategy($this->renderMock());
        $result = $strategy->selectRenderer($eventMock);

        $this->assertNull($result);
    }

    public function testRetornaInstanciaDeBoletoPdfModel()
    {
        $boletoPdfModelMock = $this->getMockBuilder(BoletoPdfModel::class)->disableOriginalConstructor()->getMock();
        $eventMock = $this->viewEventMock();
        $eventMock->method('getModel')->willReturn($boletoPdfModelMock);

        $strategy = new PdfStrategy($this->renderMock());
        $result = $strategy->selectRenderer($eventMock);

        $this->assertInstanceOf(RendererInterface::class, $result);
    }

    public function testVerificaSeRetornaNullCasoInjectResponseSejaDiferenteOsRenderer()
    {
        $eventMock = $this->viewEventMock();
        $eventMock->method('getRenderer')->willReturn(null);

        $strategy = new PdfStrategy($this->renderMock());
        $result = $strategy->injectResponse($eventMock);

        $this->assertNull($result);
    }

    public function testVerificaSeRetornaNullCasoInjectResponseNaoSejaArray()
    {
        $renderMock = $this->renderMock();
        $eventMock = $this->viewEventMock();
        $eventMock->method('getRenderer')->willReturn($renderMock);
        $eventMock->method('getResult')->willReturn('xpto');

        $strategy = new PdfStrategy($renderMock);
        $result = $strategy->injectResponse($eventMock);

        $this->assertNull($result);
    }

    public function testVerificaSeRetornaDadosEsperadosDeInjectResponse()
    {
        $boletoMock = $this->getMockBuilder(Boleto::class)->getMock();
        $boletoMock->method('renderPDF')->willReturn('boletoMock');

        $headersMock = $this->getMockBuilder(Headers::class)->disableOriginalConstructor()->getMock();
        $responseMock = $this->getMockBuilder(Response::class)->disableOriginalConstructor()->getMock();
        $responseMock->method('getHeaders')->willReturn($headersMock);

        $renderMock = $this->renderMock();
        $eventMock = $this->viewEventMock();
        $eventMock->method('getResponse')->willReturn($responseMock);
        $eventMock->method('getRenderer')->willReturn($renderMock);
        $eventMock->method('getResult')->willReturn([
            'name' => 'abc',
            'boleto' => $boletoMock
        ]);

        $strategy = new PdfStrategy($renderMock);
        $result = $strategy->injectResponse($eventMock);

        $this->assertNull($result);
    }

    private function viewEventMock()
    {
        return $this->getMockBuilder(ViewEvent::class)->disableOriginalConstructor()->getMock();
    }

    private function renderMock()
    {
        return $this->getMockBuilder(RendererInterface::class)->getMock();
    }

    private function strategyMock()
    {
        return $this->getMockBuilder(PdfStrategy::class)->disableOriginalConstructor()->getMock();
    }
}

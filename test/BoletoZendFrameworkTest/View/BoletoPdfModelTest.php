<?php

namespace BoletoZendFrameworkTest\View;

use Zend\View\Model\ViewModel;
use BoletoZendFramework\View\BoletoPdfModel;
use BoletoZendFrameworkTest\Framework\TestCase;
use Eduardokum\LaravelBoleto\Contracts\Boleto\Boleto;

class BoletoPdfModelTest extends TestCase
{
    public function testVerificaSeClasseInstanciaDeZendViewModel()
    {
        $this->assertInstanceOf(ViewModel::class, new BoletoPdfModel());
    }

    /**
     * @expectedException \Zend\View\Exception\InvalidArgumentException
     * @expectedExceptionMessage Variavel "data" não encontrada ou não é instância de Boleto.
     */
    public function testVerificaSeRetornaExceptionNoMetodoSerialize()
    {
        $model = new BoletoPdfModel();
        $model->serialize();
    }

    public function testVerificaSeRetornaArrayDoMetodoSerialize()
    {
        $boleto = $this->getMockBuilder(Boleto::class)->getMock();

        $model = new BoletoPdfModel(['data' => $boleto], ['name' => 'xpto']);
        $result = $model->serialize();

        $this->assertEquals([
            'boleto' => $boleto,
            'name' => 'xpto'
        ], $result);
    }
}

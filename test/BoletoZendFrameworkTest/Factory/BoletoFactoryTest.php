<?php

namespace BoletoZendFrameworkTest\Factory;

use BoletoZendFramework\Factory\BoletoFactory;
use BoletoZendFramework\Service\BoletoService;
use BoletoZendFramework\Service\BoletoServiceInterface;
use BoletoZendFrameworkTest\Framework\ServiceManager;
use BoletoZendFrameworkTest\Framework\TestCase;
use Zend\ServiceManager\Factory\FactoryInterface;

class BoletoFactoryTest extends TestCase
{
    use ServiceManager;

    public function test_verifica_se_implementa_FactoryInterface_do_Zend()
    {
        $boletoFactory = new BoletoFactory();
        $this->assertInstanceOf(FactoryInterface::class, $boletoFactory);
    }

    /**
     * @expectedException \BoletoZendFramework\Exception\BoletoZendFrameworkException
     * @expectedExceptionMessage Configuração não encontrada.
     */
    public function test_verifica_se_retorna_exception_caso_boleto_nao_exista()
    {
        $boletoFactory = new BoletoFactory();
        $boletoFactory->__invoke($this->getServiceManager(), '');
    }

    public function test_verifica_se_metodo_invoke_retorna_instancia_de_BoletoService()
    {
        $boletoFactory = new BoletoFactory();
        $this->assertInstanceOf(BoletoService::class, $boletoFactory->__invoke($this->serviceManager(), ''));
    }

    public function test_verifica_se_metodos_retorna_a_propria_classe()
    {
        $boletoFactory = new BoletoFactory();

        $this->assertInstanceOf(BoletoFactory::class, $boletoFactory->setDadosPagador([]));
        $this->assertInstanceOf(BoletoFactory::class, $boletoFactory->setDadosBoleto([]));
    }

    public function test_verifica_se_metodo_invoke_retorna_os_dados_esperados()
    {
        $pagador = [
            'nome' => 'Cliente',
            'endereco' => 'Rua um, 123',
            'bairro' => 'Bairro',
            'cep' => '99999-999',
            'uf' => 'UF',
            'cidade' => 'CIDADE',
            'documento' => '999.999.999-99',
        ];

        $dadosBoleto = [
            'dataVencimento' => new \Carbon\Carbon('1790-01-01'),
            'valor' => 100.00,
            'numero' => 1,
            'numeroDocumento' => 1,
            'codigoCliente' => 99999,
        ];

        $boletoFactory = new BoletoFactory();
        $boletoFactory->setDadosPagador($pagador);
        $boletoFactory->setDadosBoleto($dadosBoleto);

        $boletoService = $boletoFactory->__invoke($this->serviceManager(), '');
        $boleto = $boletoService->getBoleto(BoletoServiceInterface::CAIXA);
        $data = $boleto->toArray();

        $this->assertEquals('100,00', $data['valor']);
        $this->assertEquals(1, $data['numero']);
    }
}

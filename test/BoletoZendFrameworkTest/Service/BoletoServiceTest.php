<?php

namespace BoletoZendFrameworkTest\Service;

use BoletoZendFramework\Service\BoletoServiceInterface;
use BoletoZendFrameworkTest\Framework\TestCase;
use BoletoZendFramework\Service\BoletoService;
use Eduardokum\LaravelBoleto\Boleto\Banco\Bancoob;
use Eduardokum\LaravelBoleto\Boleto\Banco\Banrisul;
use Eduardokum\LaravelBoleto\Boleto\Banco\Bb;
use Eduardokum\LaravelBoleto\Boleto\Banco\Bradesco;
use Eduardokum\LaravelBoleto\Boleto\Banco\Caixa;
use Eduardokum\LaravelBoleto\Boleto\Banco\Itau;
use Eduardokum\LaravelBoleto\Boleto\Banco\Santander;
use Eduardokum\LaravelBoleto\Boleto\Banco\Sicredi;

class BoletoServiceTest extends TestCase
{
    public function test_verifica_se_implementa_interface_BoletoServiceInterface()
    {
        $service = new BoletoService();
        $this->assertInstanceOf(BoletoServiceInterface::class, $service);
    }

    public function test_verifica_se_metodos_retorna_a_propria_classe()
    {
        $service = new BoletoService();

        $this->assertInstanceOf(BoletoService::class, $service->setDadosPagador([]));
        $this->assertInstanceOf(BoletoService::class, $service->setDadosBeneficiario([]));
        $this->assertInstanceOf(BoletoService::class, $service->setDadosBoleto([]));
    }

    /**
     * @expectedException \BoletoZendFramework\Exception\BoletoZendFrameworkException
     * @expectedExceptionMessage Boleto não encontrado.
     */
    public function test_verifica_se_retorna_exception_caso_boleto_nao_exista()
    {
        $service = new BoletoService();
        $service->getBoleto('XPTO');
    }

    public function dataProvider()
    {
        return [
            [BoletoServiceInterface::CAIXA, Caixa::class],
            [BoletoServiceInterface::BANCOOB, Bancoob::class],
            [BoletoServiceInterface::BANRISUL, Banrisul::class],
            [BoletoServiceInterface::BB, Bb::class],
            [BoletoServiceInterface::BRADESCO, Bradesco::class],
            [BoletoServiceInterface::ITAU, Itau::class],
            [BoletoServiceInterface::SANTANDER, Santander::class],
            [BoletoServiceInterface::SICREDI, Sicredi::class],
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    public function test_verifica_se_metodo_getBoleto_retorna_instancia_de_boleto($boleto, $instancia)
    {
        $service = new BoletoService();
        $this->assertInstanceOf($instancia, $service->getBoleto($boleto));
    }

    public function test_verifica_se_adiciona_o_pagador()
    {
        $pagador = [
            'nome' => 'Cliente',
            'endereco' => 'Rua um, 123',
            'bairro' => 'Bairro',
            'cep' => '99999-999',
            'uf' => 'UF',
            'cidade' => 'CIDADE',
            'documento' => '999.999.999-99',
            'nome_documento' => 'Cliente / CPF: 999.999.999-99', //este valor gera automático
            'endereco2' => '99999-999 - CIDADE - UF' //este valor gera automático
        ];

        $service = new BoletoService();
        $service->setDadosPagador($pagador);
        $boleto = $service->getBoleto(BoletoServiceInterface::CAIXA);

        $boletoPagador = $boleto->getPagador()->toArray();

        $this->assertEquals($pagador, $boletoPagador);
    }

    public function test_verifica_se_adiciona_o_beneficiario()
    {
        $beneficiario = [
            'nome' => 'ACME',
            'endereco' => 'Rua um, 123',
            'bairro' => 'Bairro',
            'cep' => '99999-999',
            'uf' => 'UF',
            'cidade' => 'CIDADE',
            'documento' => '99.999.999/9999-99',
            'nome_documento' => 'ACME / CNPJ: 99.999.999/9999-99', //este valor gera automático
            'endereco2' => '99999-999 - CIDADE - UF' //este valor gera automático
        ];

        $service = new BoletoService();
        $service->setDadosBeneficiario($beneficiario);
        $boleto = $service->getBoleto(BoletoServiceInterface::CAIXA);

        $boletoBeneficiario = $boleto->getBeneficiario()->toArray();

        $this->assertEquals($beneficiario, $boletoBeneficiario);
    }
}

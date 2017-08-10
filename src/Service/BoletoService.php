<?php

namespace BoletoZendFramework\Service;

use Eduardokum\LaravelBoleto\Pessoa;
use Eduardokum\LaravelBoleto\Contracts\Boleto\Boleto;
use BoletoZendFramework\Exception\BoletoZendFrameworkException;

class BoletoService implements BoletoServiceInterface
{
    protected $config = [];
    protected $dadosBoleto = [];
    protected $dadosPagador = [];
    protected $dadosBeneficiario = [];

    public function __construct(array $config = [])
    {
        if (!isset($config['boleto-zendframework'])) {
            throw new BoletoZendFrameworkException('Configuração não encontrada.');
        }

        $this->config = $config;
    }

    public function setDadosPagador(array $dados)
    {
        $this->dadosPagador = $dados;
        return $this;
    }

    public function setDadosBeneficiario(array $dados)
    {
        $this->dadosBeneficiario = $dados;
        return $this;
    }

    public function setDadosBoleto(array $dados)
    {
        $this->dadosBoleto = $dados;
        return $this;
    }

    public function getBoleto($boleto = self::CAIXA) : Boleto
    {
        $class = '\\Eduardokum\\LaravelBoleto\\Boleto\\Banco\\'.$boleto;
        if (!class_exists($class)) {
            throw new BoletoZendFrameworkException('Boleto não encontrado.');
        }

        $dadosBeneficiario = array_merge(
            $this->config['boleto-zendframework']['beneficiario'],
            $this->dadosBeneficiario
        );

        $beneficiario = new Pessoa($dadosBeneficiario);
        $pagador = new Pessoa($this->dadosPagador);

        $dadosBoleto = array_merge(
            $this->config['boleto-zendframework']['dados-boleto'],
            $this->dadosBoleto
        );

        $dados = array_merge($dadosBoleto, [
            'pagador' => $pagador,
            'beneficiario' => $beneficiario,
        ]);

        return new $class($dados);
    }
}

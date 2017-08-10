<?php

namespace BoletoZendFramework\Service;

use Eduardokum\LaravelBoleto\Pessoa;
use Eduardokum\LaravelBoleto\Contracts\Boleto\Boleto;
use BoletoZendFramework\Exception\BoletoZendFrameworkException;

class BoletoService implements BoletoServiceInterface
{
    protected $dadosPagador = [];
    protected $dadosBeneficiario = [];
    protected $dadosBoleto = [];

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
        $beneficiario = new Pessoa($this->dadosBeneficiario);
        $pagador = new Pessoa($this->dadosPagador);

        $dados = array_merge($this->dadosBoleto, [
            'pagador' => $pagador,
            'beneficiario' => $beneficiario,
        ]);

        $class = '\\Eduardokum\\LaravelBoleto\\Boleto\\Banco\\'.$boleto;
        if (!class_exists($class)) {
            throw new BoletoZendFrameworkException('Boleto não encontrado.');
        }

        return new $class($dados);
    }
}

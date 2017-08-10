<?php

namespace BoletoZendFramework\Service;

use Eduardokum\LaravelBoleto\Contracts\Boleto\Boleto;

interface BoletoServiceInterface
{
    const CAIXA = 'Caixa';
    const BANCOOB = 'Bancoob';
    const BANRISUL = 'Banrisul';
    const BB = 'Bb';
    const BRADESCO = 'Bradesco';
    const HSBC = 'Hsbc';
    const ITAU = 'Itau';
    const SANTANDER = 'Santander';
    const SICREDI = 'Sicredi';

    public function setDadosPagador(array $dados);
    public function setDadosBeneficiario(array $dados);
    public function setDadosBoleto(array $dados);
    public function getBoleto($banco = self::CAIXA) : Boleto;
}
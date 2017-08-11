<?php

namespace BoletoZendFramework\View;

use Zend\View\Exception;
use Zend\View\Model\ViewModel;
use Eduardokum\LaravelBoleto\Contracts\Boleto\Boleto;

class BoletoPdfModel extends ViewModel
{
    protected $captureTo = null;
    protected $terminate = true;

    public function serialize()
    {
        $data = $this->getVariable('data');
        if (!$data instanceof Boleto) {
            throw new Exception\InvalidArgumentException('Variavel "data" não encontrada ou não é instância de Boleto.');
        }

        return [
            'boleto' => $data,
            'name' => $this->getOption('name')
        ];
    }
}

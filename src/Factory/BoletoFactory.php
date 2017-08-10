<?php

namespace BoletoZendFramework\Factory;

use Interop\Container\ContainerInterface;
use BoletoZendFramework\Service\BoletoService;
use Zend\ServiceManager\Factory\FactoryInterface;
use BoletoZendFramework\Exception\BoletoZendFrameworkException;

class BoletoFactory implements FactoryInterface
{
    protected $dadosBoleto = [];
    protected $dadosPagador = [];

    /**
     * {@inheritdoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config');
        if (!isset($config['boleto-zendframework'])) {
            throw new BoletoZendFrameworkException('Configuração não encontrada.');
        }

        $boletoService = new BoletoService();
        $boletoService->setDadosPagador($this->dadosPagador)
            ->setDadosBeneficiario($config['boleto-zendframework']['beneficiario'])
            ->setDadosBoleto(array_merge(
                $config['boleto-zendframework']['dados-boleto'],
                $this->dadosBoleto
            ));

        return $boletoService;
    }

    public function setDadosPagador(array $dados)
    {
        $this->dadosPagador = $dados;
        return $this;
    }

    public function setDadosBoleto(array $dados)
    {
        $this->dadosBoleto = $dados;
        return $this;
    }
}

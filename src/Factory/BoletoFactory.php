<?php

namespace BoletoZendFramework\Factory;

use Interop\Container\ContainerInterface;
use BoletoZendFramework\Service\BoletoService;
use Zend\ServiceManager\Factory\FactoryInterface;
use BoletoZendFramework\Exception\BoletoZendFrameworkException;

class BoletoFactory implements FactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config');
        if (!isset($config['boleto-zendframework'])) {
            throw new BoletoZendFrameworkException('Configuração não encontrada.');
        }

        return new BoletoService($config);
    }
}

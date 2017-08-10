<?php

namespace BoletoZendFramework\Factory;

use Interop\Container\ContainerInterface;
use BoletoZendFramework\Service\BoletoService;
use Zend\ServiceManager\Factory\FactoryInterface;

class BoletoFactory implements FactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config');
        return new BoletoService($config);
    }
}

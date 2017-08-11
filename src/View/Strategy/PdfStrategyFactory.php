<?php

namespace BoletoZendFramework\View\Strategy;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class PdfStrategyFactory implements FactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $viewRenderer = $container->get('ViewPdfRenderer');
        return new PdfStrategy($viewRenderer);
    }
}

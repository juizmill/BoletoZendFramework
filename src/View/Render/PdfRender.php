<?php

namespace BoletoZendFramework\View\Render;

use Zend\View\Exception;
use BoletoZendFramework\View\BoletoPdfModel;
use Zend\View\Model\ModelInterface as Model;
use Zend\View\Renderer\RendererInterface as Renderer;
use Zend\View\Resolver\ResolverInterface as Resolver;

class PdfRender implements Renderer
{
    protected $resolver;

    /**
     * {@inheritdoc}
     */
    public function getEngine()
    {
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setResolver(Resolver $resolver)
    {
        $this->resolver = $resolver;
    }

    /**
     * {@inheritdoc}
     */
    public function render($nameOrModel, $values = null)
    {
        if ($nameOrModel instanceof Model && $nameOrModel instanceof BoletoPdfModel) {
            return $nameOrModel->serialize();
        }
        // Both $nameOrModel and $values are populated
        throw new Exception\DomainException(sprintf(
            '%s: Do not know how to handle operation when both $nameOrModel and $values are populated',
            __METHOD__
        ));
    }
}

<?php

namespace BoletoZendFramework\View\Strategy;

use Zend\View\ViewEvent;
use Zend\View\Renderer\RendererInterface;
use BoletoZendFramework\View\BoletoPdfModel;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\AbstractListenerAggregate;

class PdfStrategy extends AbstractListenerAggregate
{
    protected $renderer;

    public function __construct(RendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * {@inheritdoc}
     */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RENDERER, [$this, 'selectRenderer'], $priority);
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RESPONSE, [$this, 'injectResponse'], $priority);
    }

    public function selectRenderer(ViewEvent $event)
    {
        $model = $event->getModel();
        if (!$model instanceof BoletoPdfModel) {
            return;
        }

        return $this->renderer;
    }

    public function injectResponse(ViewEvent $event)
    {
        $renderer = $event->getRenderer();
        if ($renderer !== $this->renderer) {
            return;
        }

        $result = $event->getResult();
        if (!is_array($result)) {
            return;
        }

        $name = ($result['name'] == null) ? 'boleto' : $result['name'];

        /**
         * @var $response \Zend\Http\PhpEnvironment\Response
         */
        $response = $event->getResponse();

        $response->setContent($result['boleto']->renderPDF());
        $headers = $response->getHeaders();
        $headers->addHeaderLine('Content-type', 'application/pdf');
        $headers->addHeaderLine('Content-Disposition', 'inline; filename="'.$name.'"');
        $headers->addHeaderLine('Cache-Control', 'private, max-age=0, must-revalidate');
        $headers->addHeaderLine('Pragma', 'public');
    }
}

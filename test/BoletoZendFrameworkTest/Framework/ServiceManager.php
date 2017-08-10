<?php

namespace BoletoZendFrameworkTest\Framework;

trait ServiceManager
{
    /**
     * @return \Zend\ServiceManager\ServiceManager
     */
    public function serviceManager()
    {
        $serviceManager = $this->getServiceManager();
        $serviceManager->setAllowOverride(true);
        $serviceManager->setService('config', $this->updateConfigServiceManager($serviceManager->get('config')));
        $serviceManager->setAllowOverride(false);

        return $serviceManager;
    }

    public function updateConfigServiceManager($config)
    {
        return array_merge($config, include __DIR__.'/../../../config/boleto-zendframework.global.php');
    }
}

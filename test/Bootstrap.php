<?php

use BoletoZendFrameworkTest\Framework\TestCase;
use Zend\Mvc\Service\ServiceManagerConfig;
use Zend\ServiceManager\ServiceManager;

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

$configuration = array(
    'modules' => array(
        'BoletoZendFramework',
    ),
    'module_listener_options' => array(
        'config_cache_enabled' => false,
        'cache_dir' => 'data/cache',
        'module_paths' => array(
            './vendor',
            './module'
        ),
    ),
    'service_manager' => array(
        'use_defaults' => true,
    ),
);

include __DIR__ . '/../vendor/autoload.php';

// Prepare the service manager
$smConfig = isset($configuration['service_manager']) ? $configuration['service_manager'] : [];

$smConfig = new ServiceManagerConfig($smConfig);
$serviceManager = new ServiceManager();
$smConfig->configureServiceManager($serviceManager);
$serviceManager->setService('ApplicationConfig', $configuration);

// Load modules
$serviceManager->get('ModuleManager')->loadModules();

TestCase::setServiceManager($serviceManager);

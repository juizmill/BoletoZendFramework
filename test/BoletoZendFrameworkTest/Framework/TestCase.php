<?php

namespace BoletoZendFrameworkTest\Framework;

use Zend\ServiceManager\ServiceManager;
use PHPUnit\Framework\TestCase as PHPUnit_Framework_TestCase;

class TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * @var ServiceManager
     */
    protected static $serviceManager;

    /**
     * @param ServiceManager $serviceManager
     */
    public static function setServiceManager(ServiceManager $serviceManager)
    {
        self::$serviceManager = $serviceManager;
    }

    /**
     * @return ServiceManager
     */
    public function getServiceManager()
    {
        return self::$serviceManager;
    }
}

<?php

namespace ZendServiceTest\ServiceManager;

use BoletoZendFramework\Service\BoletoService;
use BoletoZendFrameworkTest\Framework\TestCase;
use BoletoZendFrameworkTest\Framework\ServiceManager;

class BoletoTest extends TestCase
{
    use ServiceManager;

    public function testVerificaSeServicoEstaProntoParaSerUsadoNoZend()
    {
        $boletoFactory = $this->serviceManager()->get('boleto.zend.framework');
        $this->assertInstanceOf(BoletoService::class, $boletoFactory);
    }
}

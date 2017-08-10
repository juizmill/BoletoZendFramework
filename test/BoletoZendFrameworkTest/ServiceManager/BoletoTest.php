<?php

namespace ZendServiceTest\ServiceManager;

use BoletoZendFramework\Service\BoletoService;
use BoletoZendFrameworkTest\Framework\TestCase;
use BoletoZendFrameworkTest\Framework\ServiceManager;

class BoletoTest extends TestCase
{
    use ServiceManager;

    public function test_verifica_se_servico_esta_pronto_para_ser_usado_no_zend()
    {
        $boletoFactory = $this->serviceManager()->get('boleto.zend.framework');
        $this->assertInstanceOf(BoletoService::class, $boletoFactory);
    }
}

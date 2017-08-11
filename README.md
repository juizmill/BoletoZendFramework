# BoletoZendFramework

[![Packagist](https://img.shields.io/packagist/dt/juizmill/boleto-zend-framework.svg?style=flat-square)](https://github.com/juizmill/BoletoZendFramework)
[![Build Status](https://travis-ci.org/juizmill/BoletoZendFramework.svg?branch=master)](https://travis-ci.org/juizmill/BoletoZendFramework)
[![Packagist](https://img.shields.io/packagist/l/juizmill/boleto-zend-framework.svg?style=flat-square)](https://github.com/juizmill/BoletoZendFramework)
[![Code Climate](https://codeclimate.com/github/juizmill/BoletoZendFramework/badges/gpa.svg)](https://codeclimate.com/github/juizmill/BoletoZendFramework)
[![Test Coverage](https://codeclimate.com/github/juizmill/BoletoZendFramework/badges/coverage.svg)](https://codeclimate.com/github/juizmill/BoletoZendFramework/coverage)
[![Issue Count](https://codeclimate.com/github/juizmill/BoletoZendFramework/badges/issue_count.svg)](https://codeclimate.com/github/juizmill/BoletoZendFramework)

Modulo Zend Framework para boletos

Este projeto é uma adaptação do projeto [laravel-boleto](https://github.com/eduardokum/laravel-boleto) Para ZF3.


# Configuração

No arquivo `module.config.php` adiciona `BoletoZendFramework`

Copie o arquivo `boleto-zendframework.golbal.php` para a pasta autoload do seu projeto, este arquivo você configura alguns parametros do banco.

No controller você pode fazer algo deste tipo sendo que `$this->boletoService` é o serviço `boleto.zend.framework`

```
    public function boletoAction()
    {
        $pagador = [
            'nome' => 'Cliente',
            'endereco' => 'Rua um, 123',
            'bairro' => 'Bairro',
            'cep' => '99999-999',
            'uf' => 'UF',
            'cidade' => 'CIDADE',
            'documento' => '999.999.999-99',
        ];

        $dadosBoleto = [
            'dataVencimento' => new \Carbon\Carbon('1790-01-01'),
            'valor' => 100.00,
            'numero' => 1,
            'numeroDocumento' => 1,
            'codigoCliente' => 99999,
        ];

        $boleto = $this->boletoService->setDadosBoleto($dadosBoleto)
            ->setDadosPagador($pagador)
            ->getBoleto(BoletoServiceInterface::CAIXA);

        $response = new Response();
        $header = new Headers();
        $header->addHeaders([
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; boleto.pdf',
        ]);
        $response->setHeaders($header);
        $response->setStatusCode(200);
        $response->setContent($boleto->renderPDF());

        return $response;
    }
```

Caso prefira usar a estratégia, basta adicionar no `module.config.php` 

```
    'view_manager' => [
        'strategies' => [
            'ViewPdfStrategy'
        ],
    ]
```

No controller você faz desta forma: 

```
        $boleto = $this->boletoService->setDadosBoleto($dadosBoleto)
            ->setDadosPagador($pagador)
            ->getBoleto(BoletoServiceInterface::CAIXA);

        return new PdfModel(['data' => $boleto], ['name' => 'Nome do boleto para donwload']);
```
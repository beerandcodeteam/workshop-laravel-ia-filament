<?php

use PhpMcp\Laravel\Facades\Mcp;
Use App\Services\{WriterService};

Mcp::tool([WriterService::class, 'list'])
    ->name('listaEscritores')
    ->description('Lista todos os escritores');

Mcp::tool([WriterService::class, 'create'])
    ->name('criaEscritor')
    ->description('Cria escritor')
    ->inputSchema([
        'type' => 'object',
        'properties' => [
            'data' => [
                'type' => 'object',
                'properties' => [
                    'name' => [
                        'type' => 'string',
                        'description' => 'Nome do escritor'
                    ]
                ]
            ]
        ]
    ]);


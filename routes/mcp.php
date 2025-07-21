<?php

use PhpMcp\Laravel\Facades\Mcp;
use App\Services\{
    WriterService,
    ScriptService,
    GenreService,
    CharacterService,
    ThemeService,
    ConflictService,
    EnvironmentService,
    ColorPaletteService,
    NarrativePaceService,
    VisualElementService,
    EmotionalCurveService,
    UserService
};

// ================================
// WRITER SERVICE METHODS
// ================================

Mcp::tool([WriterService::class, 'list'])
    ->name('listaEscritores')
    ->description('Lista todos os escritores cadastrados no sistema');

Mcp::tool([WriterService::class, 'create'])
    ->name('cadastraEscritor')
    ->description('Cadastra um novo escritor')
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
                ],
                'required' => ['name']
            ]
        ],
        'required' => ['data']
    ]);

// ================================
// SCRIPT SERVICE METHODS
// ================================

Mcp::tool([ScriptService::class, 'list'])
    ->name('listaScripts')
    ->description('Lista todos os scripts com relacionamentos');

Mcp::tool([ScriptService::class, 'update'])
    ->name('atualizaScript')
    ->description('Atualiza um script existente')
    ->inputSchema([
        'type' => 'object',
        'properties' => [
            'script_id' => [
                'type' => 'integer',
                'description' => 'ID do script'
            ],
            'data' => [
                'type' => 'object',
                'properties' => [
                    'title' => [
                        'type' => 'string',
                        'description' => 'Título do script'
                    ],
                    'writer_id' => [
                        'type' => 'integer',
                        'description' => 'ID do escritor'
                    ],
                    'year' => [
                        'type' => 'integer',
                        'description' => 'Ano do script'
                    ],
                    'one_liner' => [
                        'type' => 'string',
                        'description' => 'One liner do script'
                    ],
                    'short_synopsis' => [
                        'type' => 'string',
                        'description' => 'Sinopse curta'
                    ],
                    'era' => [
                        'type' => 'string',
                        'description' => 'Era/período'
                    ],
                    'suggested_style' => [
                        'type' => 'string',
                        'description' => 'Estilo sugerido'
                    ],
                    'expected_impact' => [
                        'type' => 'string',
                        'description' => 'Impacto esperado'
                    ],
                    'genre_ids'          => [
                        'type'        => 'string',
                        'description' => 'IDs dos gêneros separados por virgulas',
                    ],
                    'character_ids'      => [
                        'type'        => 'string',
                        'description' => 'IDs dos personagens separados por virgulas',
                    ],
                    'theme_ids'          => [
                        'type'        => 'string',
                        'description' => 'IDs dos temas separados por virgulas',
                    ],
                ],
                'required' => ['title', 'writer_id', 'year', 'one_liner', 'short_synopsis', 'era', 'suggested_style', 'expected_impact', 'genre_ids', 'character_ids', 'theme_ids'],
            ]
        ],
        'required' => ['script_id', 'data']
    ]);

// ================================
// GENRE SERVICE METHODS
// ================================

Mcp::tool([GenreService::class, 'list'])
    ->name('listaGeneros')
    ->description('Lista todos os gêneros de filmes cadastrados');

Mcp::tool([GenreService::class, 'create'])
    ->name('cadastraGenero')
    ->description('Cadastra um novo gênero de filme')
    ->inputSchema([
        'type' => 'object',
        'properties' => [
            'data' => [
                'type' => 'object',
                'properties' => [
                    'name' => [
                        'type' => 'string',
                        'description' => 'Nome do gênero'
                    ]
                ],
                'required' => ['name']
            ]
        ],
        'required' => ['data']
    ]);

// ================================
// CHARACTER SERVICE METHODS
// ================================

Mcp::tool([CharacterService::class, 'list'])
    ->name('listaPersonagens')
    ->description('Lista todos os personagens de filmes cadastrados');

Mcp::tool([CharacterService::class, 'create'])
    ->name('cadastraPersonagem')
    ->description('Cadastra um novo personagem com nome, papel, e descrição')
    ->inputSchema([
        'type' => 'object',
        'properties' => [
            'data' => [
                'type' => 'object',
                'properties' => [
                    'name' => [
                        'type' => 'string',
                        'description' => 'Nome do personagem'
                    ],
                    'role' => [
                        'type' => 'string',
                        'description' => 'Papel do personagem'
                    ],
                    'description' => [
                        'type' => 'string',
                        'description' => 'Descrição do personagem'
                    ]
                ],
                'required' => ['name', 'role', 'description']
            ]
        ],
        'required' => ['data']
    ]);

// ================================
// THEME SERVICE METHODS
// ================================

Mcp::tool([ThemeService::class, 'list'])
    ->name('listaTemas')
    ->description('Lista todos os temas narrativos cadastrados');

Mcp::tool([ThemeService::class, 'create'])
    ->name('cadastraTema')
    ->description('Cadastra um novo tema narrativo')
    ->inputSchema([
        'type' => 'object',
        'properties' => [
            'data' => [
                'type' => 'object',
                'properties' => [
                    'name' => [
                        'type' => 'string',
                        'description' => 'Nome do tema'
                    ]
                ],
                'required' => ['name']
            ]
        ],
        'required' => ['data']
    ]);


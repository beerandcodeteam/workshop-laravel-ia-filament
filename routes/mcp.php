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
    ->description('Lista todos os escritores');

Mcp::tool([WriterService::class, 'create'])
    ->name('criaEscritor')
    ->description('Cria um novo escritor')
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

Mcp::tool([WriterService::class, 'update'])
    ->name('atualizaEscritor')
    ->description('Atualiza um escritor existente')
    ->inputSchema([
        'type' => 'object',
        'properties' => [
            'writer' => [
                'type' => 'integer',
                'description' => 'ID do escritor'
            ],
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
        'required' => ['writer', 'data']
    ]);

Mcp::tool([WriterService::class, 'delete'])
    ->name('deletaEscritor')
    ->description('Remove um escritor')
    ->inputSchema([
        'type' => 'object',
        'properties' => [
            'writer' => [
                'type' => 'integer',
                'description' => 'ID do escritor'
            ]
        ],
        'required' => ['writer']
    ]);

Mcp::tool([WriterService::class, 'findById'])
    ->name('buscaEscritorPorId')
    ->description('Busca um escritor por ID')
    ->inputSchema([
        'type' => 'object',
        'properties' => [
            'id' => [
                'type' => 'integer',
                'description' => 'ID do escritor'
            ]
        ],
        'required' => ['id']
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
            'script' => [
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
                    'processed_at' => [
                        'type' => 'string',
                        'format' => 'date-time',
                        'description' => 'Data/hora de processamento'
                    ],
                    'genre_ids'          => [
                        'type'        => 'string',
                        'description' => 'IDs dos gêneros separados por virgulas',
                    ],
                    'character_ids'      => [
                        'type'        => 'string',
                        'description' => 'IDs dos personagens separados por virgulas',
                    ],
                    'conflict_ids'       => [
                        'type'        => 'string',
                        'description' => 'IDs dos conflitos separados por virgulas',
                    ],
                    'theme_ids'          => [
                        'type'        => 'string',
                        'description' => 'IDs dos temas separados por virgulas',
                    ],
                    'environment_ids'    => [
                        'type'        => 'string',
                        'description' => 'IDs dos ambientes separados por virgulas',
                    ],
                    'color_palette_ids'  => [
                        'type'        => 'string',
                        'description' => 'IDs das paletas de cores separados por virgulas',
                    ],
                    'visual_element_ids' => [
                        'type'        => 'string',
                        'description' => 'IDs dos elementos visuais separados por virgulas',
                    ],
                    'narrative_pace_ids' => [
                        'type'        => 'string',
                        'description' => 'IDs dos ritmos narrativos separados por virgulas',
                    ],
                    'emotional_curve_ids'=> [
                        'type'        => 'string',
                        'description' => 'IDs das curvas emocionais separados por virgulas',
                    ],
                ]
            ]
        ],
        'required' => ['script', 'data']
    ]);

Mcp::tool([ScriptService::class, 'delete'])
    ->name('deletaScript')
    ->description('Remove um script e seus relacionamentos')
    ->inputSchema([
        'type' => 'object',
        'properties' => [
            'script' => [
                'type' => 'integer',
                'description' => 'ID do script'
            ]
        ],
        'required' => ['script']
    ]);

Mcp::tool([ScriptService::class, 'findById'])
    ->name('buscaScriptPorId')
    ->description('Busca um script por ID com todos os relacionamentos')
    ->inputSchema([
        'type' => 'object',
        'properties' => [
            'id' => [
                'type' => 'integer',
                'description' => 'ID do script'
            ]
        ],
        'required' => ['id']
    ]);

// ================================
// GENRE SERVICE METHODS
// ================================

Mcp::tool([GenreService::class, 'list'])
    ->name('listaGeneros')
    ->description('Lista todos os gêneros');

Mcp::tool([GenreService::class, 'create'])
    ->name('criaGenero')
    ->description('Cria um novo gênero')
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

Mcp::tool([GenreService::class, 'update'])
    ->name('atualizaGenero')
    ->description('Atualiza um gênero existente')
    ->inputSchema([
        'type' => 'object',
        'properties' => [
            'genre' => [
                'type' => 'integer',
                'description' => 'ID do gênero'
            ],
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
        'required' => ['genre', 'data']
    ]);

Mcp::tool([GenreService::class, 'delete'])
    ->name('deletaGenero')
    ->description('Remove um gênero')
    ->inputSchema([
        'type' => 'object',
        'properties' => [
            'genre' => [
                'type' => 'integer',
                'description' => 'ID do gênero'
            ]
        ],
        'required' => ['genre']
    ]);

Mcp::tool([GenreService::class, 'findById'])
    ->name('buscaGeneroPorId')
    ->description('Busca um gênero por ID')
    ->inputSchema([
        'type' => 'object',
        'properties' => [
            'id' => [
                'type' => 'integer',
                'description' => 'ID do gênero'
            ]
        ],
        'required' => ['id']
    ]);

// ================================
// CHARACTER SERVICE METHODS
// ================================

Mcp::tool([CharacterService::class, 'list'])
    ->name('listaPersonagens')
    ->description('Lista todos os personagens');

Mcp::tool([CharacterService::class, 'create'])
    ->name('criaPersonagem')
    ->description('Cria um novo personagem')
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
                'required' => ['name', 'role']
            ]
        ],
        'required' => ['data']
    ]);

Mcp::tool([CharacterService::class, 'update'])
    ->name('atualizaPersonagem')
    ->description('Atualiza um personagem existente')
    ->inputSchema([
        'type' => 'object',
        'properties' => [
            'character' => [
                'type' => 'integer',
                'description' => 'ID do personagem'
            ],
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
                ]
            ]
        ],
        'required' => ['character', 'data']
    ]);

Mcp::tool([CharacterService::class, 'delete'])
    ->name('deletaPersonagem')
    ->description('Remove um personagem')
    ->inputSchema([
        'type' => 'object',
        'properties' => [
            'character' => [
                'type' => 'integer',
                'description' => 'ID do personagem'
            ]
        ],
        'required' => ['character']
    ]);

Mcp::tool([CharacterService::class, 'findById'])
    ->name('buscaPersonagemPorId')
    ->description('Busca um personagem por ID')
    ->inputSchema([
        'type' => 'object',
        'properties' => [
            'id' => [
                'type' => 'integer',
                'description' => 'ID do personagem'
            ]
        ],
        'required' => ['id']
    ]);

// ================================
// THEME SERVICE METHODS
// ================================

Mcp::tool([ThemeService::class, 'list'])
    ->name('listaTemas')
    ->description('Lista todos os temas');

Mcp::tool([ThemeService::class, 'create'])
    ->name('criaTema')
    ->description('Cria um novo tema')
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

Mcp::tool([ThemeService::class, 'update'])
    ->name('atualizaTema')
    ->description('Atualiza um tema existente')
    ->inputSchema([
        'type' => 'object',
        'properties' => [
            'theme' => [
                'type' => 'integer',
                'description' => 'ID do tema'
            ],
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
        'required' => ['theme', 'data']
    ]);

Mcp::tool([ThemeService::class, 'delete'])
    ->name('deletaTema')
    ->description('Remove um tema')
    ->inputSchema([
        'type' => 'object',
        'properties' => [
            'theme' => [
                'type' => 'integer',
                'description' => 'ID do tema'
            ]
        ],
        'required' => ['theme']
    ]);

Mcp::tool([ThemeService::class, 'findById'])
    ->name('buscaTemaPorId')
    ->description('Busca um tema por ID')
    ->inputSchema([
        'type' => 'object',
        'properties' => [
            'id' => [
                'type' => 'integer',
                'description' => 'ID do tema'
            ]
        ],
        'required' => ['id']
    ]);

// ================================
// CONFLICT SERVICE METHODS
// ================================

Mcp::tool([ConflictService::class, 'list'])
    ->name('listaConflitos')
    ->description('Lista todos os conflitos');

Mcp::tool([ConflictService::class, 'create'])
    ->name('criaConflito')
    ->description('Cria um novo conflito')
    ->inputSchema([
        'type' => 'object',
        'properties' => [
            'data' => [
                'type' => 'object',
                'properties' => [
                    'name' => [
                        'type' => 'string',
                        'description' => 'Nome do conflito'
                    ]
                ],
                'required' => ['name']
            ]
        ],
        'required' => ['data']
    ]);

Mcp::tool([ConflictService::class, 'update'])
    ->name('atualizaConflito')
    ->description('Atualiza um conflito existente')
    ->inputSchema([
        'type' => 'object',
        'properties' => [
            'conflict' => [
                'type' => 'integer',
                'description' => 'ID do conflito'
            ],
            'data' => [
                'type' => 'object',
                'properties' => [
                    'name' => [
                        'type' => 'string',
                        'description' => 'Nome do conflito'
                    ]
                ],
                'required' => ['name']
            ]
        ],
        'required' => ['conflict', 'data']
    ]);

Mcp::tool([ConflictService::class, 'delete'])
    ->name('deletaConflito')
    ->description('Remove um conflito')
    ->inputSchema([
        'type' => 'object',
        'properties' => [
            'conflict' => [
                'type' => 'integer',
                'description' => 'ID do conflito'
            ]
        ],
        'required' => ['conflict']
    ]);

Mcp::tool([ConflictService::class, 'findById'])
    ->name('buscaConflitoPorId')
    ->description('Busca um conflito por ID')
    ->inputSchema([
        'type' => 'object',
        'properties' => [
            'id' => [
                'type' => 'integer',
                'description' => 'ID do conflito'
            ]
        ],
        'required' => ['id']
    ]);

// ================================
// ENVIRONMENT SERVICE METHODS
// ================================

Mcp::tool([EnvironmentService::class, 'list'])
    ->name('listaAmbientes')
    ->description('Lista todos os ambientes');

Mcp::tool([EnvironmentService::class, 'create'])
    ->name('criaAmbiente')
    ->description('Cria um novo ambiente')
    ->inputSchema([
        'type' => 'object',
        'properties' => [
            'data' => [
                'type' => 'object',
                'properties' => [
                    'name' => [
                        'type' => 'string',
                        'description' => 'Nome do ambiente'
                    ]
                ],
                'required' => ['name']
            ]
        ],
        'required' => ['data']
    ]);

Mcp::tool([EnvironmentService::class, 'update'])
    ->name('atualizaAmbiente')
    ->description('Atualiza um ambiente existente')
    ->inputSchema([
        'type' => 'object',
        'properties' => [
            'environment' => [
                'type' => 'integer',
                'description' => 'ID do ambiente'
            ],
            'data' => [
                'type' => 'object',
                'properties' => [
                    'name' => [
                        'type' => 'string',
                        'description' => 'Nome do ambiente'
                    ]
                ],
                'required' => ['name']
            ]
        ],
        'required' => ['environment', 'data']
    ]);

Mcp::tool([EnvironmentService::class, 'delete'])
    ->name('deletaAmbiente')
    ->description('Remove um ambiente')
    ->inputSchema([
        'type' => 'object',
        'properties' => [
            'environment' => [
                'type' => 'integer',
                'description' => 'ID do ambiente'
            ]
        ],
        'required' => ['environment']
    ]);

Mcp::tool([EnvironmentService::class, 'findById'])
    ->name('buscaAmbientePorId')
    ->description('Busca um ambiente por ID')
    ->inputSchema([
        'type' => 'object',
        'properties' => [
            'id' => [
                'type' => 'integer',
                'description' => 'ID do ambiente'
            ]
        ],
        'required' => ['id']
    ]);

// ================================
// COLOR PALETTE SERVICE METHODS
// ================================

Mcp::tool([ColorPaletteService::class, 'list'])
    ->name('listaPaletasCores')
    ->description('Lista todas as paletas de cores');

Mcp::tool([ColorPaletteService::class, 'create'])
    ->name('criaPaletaCores')
    ->description('Cria uma nova paleta de cores')
    ->inputSchema([
        'type' => 'object',
        'properties' => [
            'data' => [
                'type' => 'object',
                'properties' => [
                    'name' => [
                        'type' => 'string',
                        'description' => 'Nome da paleta de cores'
                    ]
                ],
                'required' => ['name']
            ]
        ],
        'required' => ['data']
    ]);

Mcp::tool([ColorPaletteService::class, 'update'])
    ->name('atualizaPaletaCores')
    ->description('Atualiza uma paleta de cores existente')
    ->inputSchema([
        'type' => 'object',
        'properties' => [
            'colorPalette' => [
                'type' => 'integer',
                'description' => 'ID da paleta de cores'
            ],
            'data' => [
                'type' => 'object',
                'properties' => [
                    'name' => [
                        'type' => 'string',
                        'description' => 'Nome da paleta de cores'
                    ]
                ],
                'required' => ['name']
            ]
        ],
        'required' => ['colorPalette', 'data']
    ]);

Mcp::tool([ColorPaletteService::class, 'delete'])
    ->name('deletaPaletaCores')
    ->description('Remove uma paleta de cores')
    ->inputSchema([
        'type' => 'object',
        'properties' => [
            'colorPalette' => [
                'type' => 'integer',
                'description' => 'ID da paleta de cores'
            ]
        ],
        'required' => ['colorPalette']
    ]);

Mcp::tool([ColorPaletteService::class, 'findById'])
    ->name('buscaPaletaCoresPorId')
    ->description('Busca uma paleta de cores por ID')
    ->inputSchema([
        'type' => 'object',
        'properties' => [
            'id' => [
                'type' => 'integer',
                'description' => 'ID da paleta de cores'
            ]
        ],
        'required' => ['id']
    ]);

// ================================
// NARRATIVE PACE SERVICE METHODS
// ================================

Mcp::tool([NarrativePaceService::class, 'list'])
    ->name('listaRitmosNarrativos')
    ->description('Lista todos os ritmos narrativos');

Mcp::tool([NarrativePaceService::class, 'create'])
    ->name('criaRitmoNarrativo')
    ->description('Cria um novo ritmo narrativo')
    ->inputSchema([
        'type' => 'object',
        'properties' => [
            'data' => [
                'type' => 'object',
                'properties' => [
                    'name' => [
                        'type' => 'string',
                        'description' => 'Nome do ritmo narrativo'
                    ]
                ],
                'required' => ['name']
            ]
        ],
        'required' => ['data']
    ]);

Mcp::tool([NarrativePaceService::class, 'update'])
    ->name('atualizaRitmoNarrativo')
    ->description('Atualiza um ritmo narrativo existente')
    ->inputSchema([
        'type' => 'object',
        'properties' => [
            'narrativePace' => [
                'type' => 'integer',
                'description' => 'ID do ritmo narrativo'
            ],
            'data' => [
                'type' => 'object',
                'properties' => [
                    'name' => [
                        'type' => 'string',
                        'description' => 'Nome do ritmo narrativo'
                    ]
                ],
                'required' => ['name']
            ]
        ],
        'required' => ['narrativePace', 'data']
    ]);

Mcp::tool([NarrativePaceService::class, 'delete'])
    ->name('deletaRitmoNarrativo')
    ->description('Remove um ritmo narrativo')
    ->inputSchema([
        'type' => 'object',
        'properties' => [
            'narrativePace' => [
                'type' => 'integer',
                'description' => 'ID do ritmo narrativo'
            ]
        ],
        'required' => ['narrativePace']
    ]);

Mcp::tool([NarrativePaceService::class, 'findById'])
    ->name('buscaRitmoNarrativoPorId')
    ->description('Busca um ritmo narrativo por ID')
    ->inputSchema([
        'type' => 'object',
        'properties' => [
            'id' => [
                'type' => 'integer',
                'description' => 'ID do ritmo narrativo'
            ]
        ],
        'required' => ['id']
    ]);

// ================================`

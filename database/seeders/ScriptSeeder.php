<?php

namespace Database\Seeders;

use App\Models\Writer;
use App\Models\Script;
use App\Models\Genre;
use App\Models\Theme;
use App\Models\Conflict;
use App\Models\Environment;
use App\Models\ColorPalette;
use App\Models\NarrativePace;
use App\Models\VisualElement;
use App\Models\EmotionalCurve;
use App\Models\Character;
use Illuminate\Database\Seeder;

class ScriptSeeder extends Seeder
{
    public function run(): void
    {
        // Criar escritores
        $writers = [
            'Christopher Nolan',
            'Quentin Tarantino',
            'Martin Scorsese',
            'Greta Gerwig',
            'Jordan Peele',
            'Denis Villeneuve',
            'Chloe Zhao',
            'Spike Lee',
        ];

        foreach ($writers as $writerName) {
            Writer::firstOrCreate(['name' => $writerName]);
        }

        // Criar gêneros
        $genres = [
            'Drama', 'Comédia', 'Ação', 'Thriller', 'Terror', 'Ficção Científica',
            'Romance', 'Aventura', 'Mistério', 'Fantasia', 'Crime', 'Guerra',
            'Western', 'Documentário', 'Animação', 'Musical'
        ];

        foreach ($genres as $genreName) {
            Genre::firstOrCreate(['name' => $genreName]);
        }

        // Criar temas
        $themes = [
            'Amor e Relacionamentos', 'Justiça e Moralidade', 'Poder e Corrupção',
            'Família e Tradição', 'Identidade e Autodescoberta', 'Liberdade vs Segurança',
            'Tecnologia e Humanidade', 'Bem vs Mal', 'Vingança', 'Redenção',
            'Amadurecimento', 'Sacrifício', 'Traição', 'Esperança', 'Solidão'
        ];

        foreach ($themes as $themeName) {
            Theme::firstOrCreate(['name' => $themeName]);
        }

        // Criar conflitos
        $conflicts = [
            'Homem vs Homem', 'Homem vs Natureza', 'Homem vs Sociedade',
            'Homem vs Tecnologia', 'Homem vs Sobrenatural', 'Homem vs Destino',
            'Interno/Psicológico', 'Familiar', 'Romântico', 'Profissional',
            'Existencial', 'Moral', 'Físico', 'Emocional'
        ];

        foreach ($conflicts as $conflictName) {
            Conflict::firstOrCreate(['name' => $conflictName]);
        }

        // Criar ambientes
        $environments = [
            'Urbano Contemporâneo', 'Rural', 'Histórico', 'Futurista',
            'Suburbano', 'Industrial', 'Natural/Selvagem', 'Marítimo',
            'Montanhoso', 'Desértico', 'Espacial', 'Subterrâneo',
            'Prisional', 'Hospitalar', 'Escolar', 'Corporativo'
        ];

        foreach ($environments as $environmentName) {
            Environment::firstOrCreate(['name' => $environmentName]);
        }

        // Criar paletas de cores
        $colorPalettes = [
            'Tons Quentes', 'Tons Frios', 'Monocromático', 'Complementares',
            'Análogas', 'Neutros', 'Vibrantes', 'Pastéis', 'Terra',
            'Metálicos', 'Neon', 'Sépia', 'Preto e Branco', 'Azul e Laranja'
        ];

        foreach ($colorPalettes as $paletteName) {
            ColorPalette::firstOrCreate(['name' => $paletteName]);
        }

        // Criar ritmos narrativos
        $narrativePaces = [
            'Muito Lento', 'Lento', 'Moderado', 'Rápido', 'Muito Rápido',
            'Variável', 'Crescente', 'Decrescente', 'Constante', 'Irregular'
        ];

        foreach ($narrativePaces as $paceName) {
            NarrativePace::firstOrCreate(['name' => $paceName]);
        }

        // Criar elementos visuais
        $visualElements = [
            'Close-ups', 'Planos Gerais', 'Movimento de Câmera', 'Iluminação Dramática',
            'Sombras', 'Reflexos', 'Simetria', 'Profundidade de Campo',
            'Composição Central', 'Regra dos Terços', 'Linhas Guia', 'Texturas',
            'Padrões', 'Contrastes', 'Silhuetas', 'Elementos Gráficos'
        ];

        foreach ($visualElements as $elementName) {
            VisualElement::firstOrCreate(['name' => $elementName]);
        }

        // Criar curvas emocionais
        $emotionalCurves = [
            'Ascendente Linear', 'Descendente Linear', 'Montanha Russa',
            'Crescimento Exponencial', 'Queda Dramática', 'Platô Emocional',
            'Ondulante', 'Em U', 'Em V', 'Espiral Ascendente',
            'Tensão Constante', 'Alívio Gradual', 'Clímax Duplo', 'Anti-clímax'
        ];

        foreach ($emotionalCurves as $curveName) {
            EmotionalCurve::firstOrCreate(['name' => $curveName]);
        }

        // Criar personagens exemplo
        $characters = [
            ['name' => 'Protagonista Principal', 'role' => 'Herói/Heroína'],
            ['name' => 'Antagonista', 'role' => 'Vilão'],
            ['name' => 'Mentor', 'role' => 'Guia'],
            ['name' => 'Aliado Fiel', 'role' => 'Companheiro'],
            ['name' => 'Interesse Romântico', 'role' => 'Par Romântico'],
            ['name' => 'Comic Relief', 'role' => 'Alívio Cômico'],
            ['name' => 'Figura Paterna/Materna', 'role' => 'Autoridade'],
            ['name' => 'Jovem Protegido', 'role' => 'Protegido'],
        ];

        foreach ($characters as $characterData) {
            Character::firstOrCreate($characterData);
        }

        // Criar alguns roteiros de exemplo
        $scriptsData = [
            [
                'title' => 'A Jornada do Herói Moderno',
                'writer_id' => Writer::where('name', 'Christopher Nolan')->first()->id,
                'year' => 2024,
                'file_path' => 'scripts/exemplo1.pdf',
                'one_liner' => 'Um jovem descobre poderes extraordinários e deve salvar o mundo.',
                'short_synopsis' => 'Em um mundo onde a tecnologia e a magia coexistem, um jovem programador descobre que possui habilidades sobrenaturais. Ele deve aprender a controlar seus poderes enquanto enfrenta uma organização secreta que ameaça destruir o equilíbrio entre os dois mundos.',
                'era' => 'Contemporâneo',
                'suggested_style' => 'Ficção Científica Épica',
                'expected_impact' => 'alto',
            ],
            [
                'title' => 'Memórias de Uma Cidade Perdida',
                'writer_id' => Writer::where('name', 'Greta Gerwig')->first()->id,
                'year' => 2023,
                'file_path' => 'scripts/exemplo2.pdf',
                'one_liner' => 'Uma mulher retorna à sua cidade natal e confronta o passado.',
                'short_synopsis' => 'Depois de 20 anos vivendo na cidade grande, Sarah volta para sua pequena cidade natal para cuidar da mãe doente. Lá, ela reencontra antigos amigos e deve confrontar segredos do passado que mudaram sua vida para sempre.',
                'era' => 'Contemporâneo',
                'suggested_style' => 'Drama Intimista',
                'expected_impact' => 'medio',
            ],
        ];

        foreach ($scriptsData as $scriptData) {
            $script = Script::create($scriptData);

            // Adicionar relacionamentos aleatórios
            $script->genres()->attach(Genre::inRandomOrder()->limit(2)->get());
            $script->themes()->attach(Theme::inRandomOrder()->limit(3)->get());
            $script->conflicts()->attach(Conflict::inRandomOrder()->limit(2)->get());
            $script->environments()->attach(Environment::inRandomOrder()->limit(1)->get());
            $script->colorPalettes()->attach(ColorPalette::inRandomOrder()->limit(1)->get());
            $script->narrativePaces()->attach(NarrativePace::inRandomOrder()->limit(1)->get());
            $script->visualElements()->attach(VisualElement::inRandomOrder()->limit(3)->get());
            $script->emotionalCurves()->attach(EmotionalCurve::inRandomOrder()->limit(1)->get());
            $script->characters()->attach(Character::inRandomOrder()->limit(4)->get());
        }
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScriptResource\Pages;
use App\Models\Script;
use App\Models\Writer;
use App\Models\Genre;
use App\Models\Conflict;
use App\Models\Theme;
use App\Models\Environment;
use App\Models\ColorPalette;
use App\Models\NarrativePace;
use App\Models\VisualElement;
use App\Models\EmotionalCurve;
use App\Models\Character;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;

class ScriptResource extends Resource
{
    protected static ?string $model = Script::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Roteiros';

    protected static ?string $modelLabel = 'Roteiro';

    protected static ?string $pluralModelLabel = 'Roteiros';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Informações do Roteiro')
                    ->tabs([
                        Tabs\Tab::make('Dados Básicos')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Forms\Components\FileUpload::make('file_path')
                                    ->label('Arquivo do roteiro em PDF')
                                    ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'text/plain'])
                                    ->directory('scripts')
                                    ->required(),
                            ])->visible(fn (string $operation): bool => $operation === 'create'),
                        Tabs\Tab::make('Dados Básicos')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Section::make('Informações Principais')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Título')
                                            ->required()
                                            ->maxLength(255),

                                        Forms\Components\Select::make('writer_id')
                                            ->label('Escritor')
                                            ->relationship('writer', 'name')
                                            ->searchable()
                                            ->preload()
                                            ->required()
                                            ->createOptionForm([
                                                Forms\Components\TextInput::make('name')
                                                    ->label('Nome do Escritor')
                                                    ->required(),
                                            ]),

                                        Forms\Components\TextInput::make('year')
                                            ->label('Ano')
                                            ->numeric()
                                            ->required()
                                            ->minValue(1900)
                                            ->maxValue(2030),

                                        Forms\Components\FileUpload::make('file_path')
                                            ->label('Arquivo do Roteiro')
                                            ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'text/plain'])
                                            ->directory('scripts')
                                            ->required(),
                                    ])
                                    ->columns(2),

                                Section::make('Sinopse e Descrição')
                                    ->schema([
                                        Forms\Components\Textarea::make('one_liner')
                                            ->label('One-liner')
                                            ->required()
                                            ->rows(2)
                                            ->columnSpanFull(),

                                        Forms\Components\Textarea::make('short_synopsis')
                                            ->label('Sinopse Curta')
                                            ->required()
                                            ->rows(4)
                                            ->columnSpanFull(),
                                    ]),
                            ])->visible(fn (string $operation): bool => $operation !== 'create'),

                        Tabs\Tab::make('Análise Criativa')
                            ->icon('heroicon-o-light-bulb')
                            ->schema([
                                Section::make('Estilo e Impacto')
                                    ->schema([
                                        Forms\Components\TextInput::make('era')
                                            ->label('Época/Era')
                                            ->placeholder('Ex: Contemporâneo, Anos 80, Medieval...'),

                                        Forms\Components\TextInput::make('suggested_style')
                                            ->label('Estilo Sugerido')
                                            ->placeholder('Ex: Thriller psicológico, Comédia romântica...'),

                                        Forms\Components\Select::make('expected_impact')
                                            ->label('Impacto Esperado')
                                            ->options([
                                                'baixo' => 'Baixo',
                                                'medio' => 'Médio',
                                                'alto' => 'Alto',
                                                'muito_alto' => 'Muito Alto',
                                            ])
                                            ->placeholder('Selecione o impacto esperado'),
                                    ])
                                    ->columns(3),
                            ])->visible(fn (string $operation): bool => $operation !== 'create'),

                        Tabs\Tab::make('Elementos Narrativos')
                            ->icon('heroicon-o-book-open')
                            ->schema([
                                Section::make('Classificação do Roteiro')
                                    ->schema([
                                        Forms\Components\Select::make('genres')
                                            ->label('Gêneros')
                                            ->relationship('genres', 'name')
                                            ->multiple()
                                            ->searchable()
                                            ->preload()
                                            ->createOptionForm([
                                                Forms\Components\TextInput::make('name')
                                                    ->label('Nome do Gênero')
                                                    ->required(),
                                            ]),

                                        Forms\Components\Select::make('themes')
                                            ->label('Temas')
                                            ->relationship('themes', 'name')
                                            ->multiple()
                                            ->searchable()
                                            ->preload()
                                            ->createOptionForm([
                                                Forms\Components\TextInput::make('name')
                                                    ->label('Nome do Tema')
                                                    ->required(),
                                            ]),

                                        Forms\Components\Select::make('conflicts')
                                            ->label('Conflitos')
                                            ->relationship('conflicts', 'name')
                                            ->multiple()
                                            ->searchable()
                                            ->preload()
                                            ->createOptionForm([
                                                Forms\Components\TextInput::make('name')
                                                    ->label('Nome do Conflito')
                                                    ->required(),
                                            ]),
                                    ])
                                    ->columns(1),
                            ])->visible(fn (string $operation): bool => $operation !== 'create'),

                        Tabs\Tab::make('Elementos Visuais')
                            ->icon('heroicon-o-camera')
                            ->schema([
                                Section::make('Aspectos Visuais e Ambientação')
                                    ->schema([
                                        Forms\Components\Select::make('environments')
                                            ->label('Ambientes')
                                            ->relationship('environments', 'name')
                                            ->multiple()
                                            ->searchable()
                                            ->preload()
                                            ->createOptionForm([
                                                Forms\Components\TextInput::make('name')
                                                    ->label('Nome do Ambiente')
                                                    ->required(),
                                            ]),

                                        Forms\Components\Select::make('colorPalettes')
                                            ->label('Paletas de Cores')
                                            ->relationship('colorPalettes', 'name')
                                            ->multiple()
                                            ->searchable()
                                            ->preload()
                                            ->createOptionForm([
                                                Forms\Components\TextInput::make('name')
                                                    ->label('Nome da Paleta')
                                                    ->required(),
                                            ]),

                                        Forms\Components\Select::make('visualElements')
                                            ->label('Elementos Visuais')
                                            ->relationship('visualElements', 'name')
                                            ->multiple()
                                            ->searchable()
                                            ->preload()
                                            ->createOptionForm([
                                                Forms\Components\TextInput::make('name')
                                                    ->label('Nome do Elemento Visual')
                                                    ->required(),
                                            ]),
                                    ])
                                    ->columns(1),
                            ])->visible(fn (string $operation): bool => $operation !== 'create'),

                        Tabs\Tab::make('Ritmo e Emoção')
                            ->icon('heroicon-o-heart')
                            ->schema([
                                Section::make('Aspectos Narrativos e Emocionais')
                                    ->schema([
                                        Forms\Components\Select::make('narrativePaces')
                                            ->label('Ritmo Narrativo')
                                            ->relationship('narrativePaces', 'name')
                                            ->multiple()
                                            ->searchable()
                                            ->preload()
                                            ->createOptionForm([
                                                Forms\Components\TextInput::make('name')
                                                    ->label('Nome do Ritmo')
                                                    ->required(),
                                            ]),

                                        Forms\Components\Select::make('emotionalCurves')
                                            ->label('Curvas Emocionais')
                                            ->relationship('emotionalCurves', 'name')
                                            ->multiple()
                                            ->searchable()
                                            ->preload()
                                            ->createOptionForm([
                                                Forms\Components\TextInput::make('name')
                                                    ->label('Nome da Curva Emocional')
                                                    ->required(),
                                            ]),
                                    ])
                                    ->columns(2),
                            ])->visible(fn (string $operation): bool => $operation !== 'create'),

                        Tabs\Tab::make('Personagens')
                            ->icon('heroicon-o-users')
                            ->schema([
                                Section::make('Elenco de Personagens')
                                    ->schema([
                                        Forms\Components\Select::make('characters')
                                            ->label('Personagens')
                                            ->relationship('characters', 'name')
                                            ->multiple()
                                            ->searchable()
                                            ->preload()
                                            ->createOptionForm([
                                                Forms\Components\TextInput::make('name')
                                                    ->label('Nome do Personagem')
                                                    ->required(),
                                                Forms\Components\TextInput::make('role')
                                                    ->label('Papel/Função')
                                                    ->required(),
                                            ]),
                                    ])
                                    ->columns(1),
                            ])->visible(fn (string $operation): bool => $operation !== 'create'),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('writer.name')
                    ->label('Escritor')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('year')
                    ->label('Ano')
                    ->sortable()
                    ->badge(),

                Tables\Columns\TextColumn::make('one_liner')
                    ->label('One-liner')
                    ->limit(50)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        return $state;
                    }),

                Tables\Columns\TextColumn::make('genres.name')
                    ->label('Gêneros')
                    ->badge()
                    ->separator(',')
                    ->color('success'),

                Tables\Columns\TextColumn::make('era')
                    ->label('Época')
                    ->badge()
                    ->color('gray')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('expected_impact')
                    ->label('Impacto')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'baixo' => 'gray',
                        'medio' => 'warning',
                        'alto' => 'success',
                        'muito_alto' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'baixo' => 'Baixo',
                        'medio' => 'Médio',
                        'alto' => 'Alto',
                        'muito_alto' => 'Muito Alto',
                        default => 'N/A',
                    })
                    ->toggleable(),

                Tables\Columns\TextColumn::make('themes.name')
                    ->label('Temas')
                    ->badge()
                    ->separator(',')
                    ->color('info')
                    ->limit(3)
                    ->toggleable(),

                Tables\Columns\TextColumn::make('characters_count')
                    ->label('Personagens')
                    ->counts('characters')
                    ->badge()
                    ->color('warning')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('writer_id')
                    ->label('Escritor')
                    ->relationship('writer', 'name')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('year')
                    ->label('Ano')
                    ->options(function () {
                        $years = Script::pluck('year')->unique()->sort()->toArray();
                        return array_combine($years, $years);
                    }),

                SelectFilter::make('expected_impact')
                    ->label('Impacto Esperado')
                    ->options([
                        'baixo' => 'Baixo',
                        'medio' => 'Médio',
                        'alto' => 'Alto',
                        'muito_alto' => 'Muito Alto',
                    ]),

                SelectFilter::make('genres')
                    ->label('Gênero')
                    ->relationship('genres', 'name')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('themes')
                    ->label('Tema')
                    ->relationship('themes', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->actions([

                Tables\Actions\EditAction::make()
                    ->label('Editar'),
                Tables\Actions\DeleteAction::make()
                    ->label('Excluir'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Excluir selecionados'),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->poll('30s');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListScripts::route('/'),
            'edit' => Pages\EditScript::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}

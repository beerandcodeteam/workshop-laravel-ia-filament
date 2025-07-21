<?php

namespace App\Filament\Resources\ScriptResource\Pages;

use App\Filament\Resources\ScriptResource;
use App\Jobs\ProcessScript;
use App\Models\Script;
use Filament\Actions;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListScripts extends ListRecords
{
    protected static string $resource = ScriptResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Novo Roteiro')
                ->modalHeading('Criar Novo Roteiro')
                ->after(function (Script $record): void {
                    ProcessScript::dispatch($record);
                }),
        ];
    }

    public function getTitle(): string
    {
        return 'Roteiros';
    }
}

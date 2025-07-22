<?php

namespace App\Filament\Resources\ScriptResource\Pages;

use App\Filament\Resources\ScriptResource;
use App\Jobs\CreateRagFromScript;
use App\Jobs\ProcessScriptData;
use App\Models\Script;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Bus;

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
                    Bus::chain([
                        new CreateRagFromScript($record),
                        (new ProcessScriptData($record))->delay(now()->addMinute()),
                    ])->dispatch();
                }),
        ];
    }

    public function getTitle(): string
    {
        return 'Roteiros';
    }
}

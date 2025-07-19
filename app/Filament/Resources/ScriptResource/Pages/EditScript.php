<?php

namespace App\Filament\Resources\ScriptResource\Pages;

use App\Filament\Resources\ScriptResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditScript extends EditRecord
{
    protected static string $resource = ScriptResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
                ->label('Visualizar'),
            Actions\DeleteAction::make()
                ->label('Excluir'),
        ];
    }

    public function getTitle(): string
    {
        return "Editar Roteiro: {$this->record->title}";
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Roteiro atualizado com sucesso!';
    }
}

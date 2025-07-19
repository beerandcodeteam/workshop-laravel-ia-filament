<?php

namespace App\Filament\Resources\ScriptResource\Pages;

use App\Filament\Resources\ScriptResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateScript extends CreateRecord
{
    protected static string $resource = ScriptResource::class;

    public function getTitle(): string
    {
        return 'Criar Roteiro';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Roteiro criado com sucesso!';
    }
}

<?php

namespace App\Services;

use App\Models\Theme;
use Illuminate\Database\Eloquent\Collection;

class ThemeService
{
    /**
     * Lista todos os temas
     */
    public function list(): Collection
    {
        return Theme::all();
    }

    /**
     * Cria um novo tema
     */
    public function create(array $data): Theme
    {
        return Theme::create($data);
    }

    /**
     * Atualiza um tema
     */
    public function update(Theme $theme, array $data): Theme
    {
        $theme->update($data);
        return $theme->fresh();
    }

    /**
     * Remove um tema
     */
    public function delete(Theme $theme): bool
    {
        return $theme->delete();
    }

    /**
     * Busca um tema por ID
     */
    public function findById(int $id): ?Theme
    {
        return Theme::find($id);
    }
}

<?php

namespace App\Services;

use App\Models\ColorPalette;
use Illuminate\Database\Eloquent\Collection;

class ColorPaletteService
{
    /**
     * Lista todas as paletas de cores
     */
    public function list(): Collection
    {
        return ColorPalette::all();
    }

    /**
     * Cria uma nova paleta de cores
     */
    public function create(array $data): ColorPalette
    {
        return ColorPalette::create($data);
    }

    /**
     * Atualiza uma paleta de cores
     */
    public function update(ColorPalette $colorPalette, array $data): ColorPalette
    {
        $colorPalette->update($data);
        return $colorPalette->fresh();
    }

    /**
     * Remove uma paleta de cores
     */
    public function delete(ColorPalette $colorPalette): bool
    {
        return $colorPalette->delete();
    }

    /**
     * Busca uma paleta de cores por ID
     */
    public function findById(int $id): ?ColorPalette
    {
        return ColorPalette::find($id);
    }
}

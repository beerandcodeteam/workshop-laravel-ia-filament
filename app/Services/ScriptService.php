<?php

namespace App\Services;

use App\Models\Script;
use Illuminate\Database\Eloquent\Collection;

class ScriptService
{
    /**
     * Lista todos os scripts
     */
    public function list(): Collection
    {
        return Script::with(['writer', 'genres', 'characters'])->get();
    }

    /**
     * Cria um novo script
     */
    public function create(array $data): Script
    {
        return Script::create($data);
    }

    /**
     * Atualiza um script
     */
    public function update(Script $script, array $data): Script
    {
        $script->update($data);
        return $script->fresh();
    }

    /**
     * Remove um script
     */
    public function delete(Script $script): bool
    {
        // Remove relacionamentos many-to-many
        $script->genres()->detach();
        $script->conflicts()->detach();
        $script->themes()->detach();
        $script->environments()->detach();
        $script->colorPalettes()->detach();
        $script->narrativePaces()->detach();
        $script->visualElements()->detach();
        $script->emotionalCurves()->detach();
        $script->characters()->detach();

        return $script->delete();
    }

    /**
     * Busca um script por ID
     */
    public function findById(int $id): ?Script
    {
        return Script::with([
            'writer',
            'genres',
            'conflicts',
            'themes',
            'environments',
            'colorPalettes',
            'narrativePaces',
            'visualElements',
            'emotionalCurves',
            'characters'
        ])->find($id);
    }
}

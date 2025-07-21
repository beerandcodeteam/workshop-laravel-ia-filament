<?php

namespace App\Services;

use App\Models\Script;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

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
        $script = Script::create($data);

        $script->genres()->sync(Arr::get($data, 'genre_ids', []));
        $script->characters()->sync(Arr::get($data, 'character_ids', []));
        $script->conflicts()->sync(Arr::get($data, 'conflict_ids', []));
        $script->themes()->sync(Arr::get($data, 'theme_ids', []));
        $script->environments()->sync(Arr::get($data, 'environment_ids', []));
        $script->colorPalettes()->sync(Arr::get($data, 'color_palette_ids', []));
        $script->visualElements()->sync(Arr::get($data, 'visual_element_ids', []));
        $script->narrativePaces()->sync(Arr::get($data, 'narrative_pace_ids', []));
        $script->emotionalCurves()->sync(Arr::get($data, 'emotional_curve_ids', []));

        return $script;
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

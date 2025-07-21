<?php

namespace App\Services;

use App\Models\Script;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

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

        $script->genres()->sync(explode(",", $data['genre_ids']));
        $script->characters()->sync(explode(",", $data['character_ids']));
        $script->themes()->sync(explode(",", $data['theme_ids']));

        return $script;
    }

    /**
     * Atualiza um script
     */
    public function update(int $script_id, array $data): Script
    {
        $script = Script::find($script_id);
        Log::warning("ATUALIZANDO SCRIPT");
        Log::info($data);

        $data['processed_at'] = now();

        $script->update($data);
        $script->genres()->sync(explode(",", $data['genre_ids']));
        $script->characters()->sync(explode(",", $data['character_ids']));
        $script->themes()->sync(explode(",", $data['theme_ids']));

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

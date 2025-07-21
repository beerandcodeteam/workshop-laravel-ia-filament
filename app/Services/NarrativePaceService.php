<?php

namespace App\Services;

use App\Models\NarrativePace;
use Illuminate\Database\Eloquent\Collection;

class NarrativePaceService
{
    /**
     * Lista todos os ritmos narrativos
     */
    public function list(): Collection
    {
        return NarrativePace::all();
    }

    /**
     * Cria um novo ritmo narrativo
     */
    public function create(array $data): NarrativePace
    {
        return NarrativePace::create($data);
    }

    /**
     * Atualiza um ritmo narrativo
     */
    public function update(NarrativePace $narrativePace, array $data): NarrativePace
    {
        $narrativePace->update($data);
        return $narrativePace->fresh();
    }

    /**
     * Remove um ritmo narrativo
     */
    public function delete(NarrativePace $narrativePace): bool
    {
        return $narrativePace->delete();
    }

    /**
     * Busca um ritmo narrativo por ID
     */
    public function findById(int $id): ?NarrativePace
    {
        return NarrativePace::find($id);
    }
}

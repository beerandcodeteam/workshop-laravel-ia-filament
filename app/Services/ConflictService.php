<?php

namespace App\Services;

use App\Models\Conflict;
use Illuminate\Database\Eloquent\Collection;

class ConflictService
{
    /**
     * Lista todos os conflitos
     */
    public function list(): Collection
    {
        return Conflict::all();
    }

    /**
     * Cria um novo conflito
     */
    public function create(array $data): Conflict
    {
        return Conflict::create($data);
    }

    /**
     * Atualiza um conflito
     */
    public function update(Conflict $conflict, array $data): Conflict
    {
        $conflict->update($data);
        return $conflict->fresh();
    }

    /**
     * Remove um conflito
     */
    public function delete(Conflict $conflict): bool
    {
        return $conflict->delete();
    }

    /**
     * Busca um conflito por ID
     */
    public function findById(int $id): ?Conflict
    {
        return Conflict::find($id);
    }
}

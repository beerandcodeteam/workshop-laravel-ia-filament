<?php

namespace App\Services;

use App\Models\Character;
use Illuminate\Database\Eloquent\Collection;

class CharacterService
{
    /**
     * Lista todos os personagens
     */
    public function list(): Collection
    {
        return Character::all();
    }

    /**
     * Cria um novo personagem
     */
    public function create(array $data): string|Character
    {
        try {
            return Character::create($data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Atualiza um personagem
     */
    public function update(Character $character, array $data): Character
    {
        $character->update($data);
        return $character->fresh();
    }

    /**
     * Remove um personagem
     */
    public function delete(Character $character): bool
    {
        return $character->delete();
    }

    /**
     * Busca um personagem por ID
     */
    public function findById(int $id): ?Character
    {
        return Character::find($id);
    }
}

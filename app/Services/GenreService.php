<?php

namespace App\Services;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Collection;

class GenreService
{
    /**
     * Lista todos os gêneros
     */
    public function list(): Collection
    {
        return Genre::all();
    }

    /**
     * Cria um novo gênero
     */
    public function create(array $data): Genre
    {
        return Genre::create($data);
    }

    /**
     * Atualiza um gênero
     */
    public function update(Genre $genre, array $data): Genre
    {
        $genre->update($data);
        return $genre->fresh();
    }

    /**
     * Remove um gênero
     */
    public function delete(Genre $genre): bool
    {
        return $genre->delete();
    }

    /**
     * Busca um gênero por ID
     */
    public function findById(int $id): ?Genre
    {
        return Genre::find($id);
    }
}

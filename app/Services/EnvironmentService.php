<?php

namespace App\Services;

use App\Models\Environment;
use Illuminate\Database\Eloquent\Collection;

class EnvironmentService
{
    /**
     * Lista todos os ambientes
     */
    public function list(): Collection
    {
        return Environment::all();
    }

    /**
     * Cria um novo ambiente
     */
    public function create(array $data): Environment
    {
        return Environment::create($data);
    }

    /**
     * Atualiza um ambiente
     */
    public function update(Environment $environment, array $data): Environment
    {
        $environment->update($data);
        return $environment->fresh();
    }

    /**
     * Remove um ambiente
     */
    public function delete(Environment $environment): bool
    {
        return $environment->delete();
    }

    /**
     * Busca um ambiente por ID
     */
    public function findById(int $id): ?Environment
    {
        return Environment::find($id);
    }
}

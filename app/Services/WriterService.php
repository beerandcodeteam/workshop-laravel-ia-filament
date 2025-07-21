<?php

namespace App\Services;

use App\Models\Writer;
use Illuminate\Database\Eloquent\Collection;

class WriterService
{
    /**
     * Lista todos os escritores
     */
    public function list(): Collection
    {
        return Writer::all();
    }

    /**
     * Cria um novo escritor
     */
    public function create(array $data): Writer
    {
        return Writer::create($data);
    }

    /**
     * Atualiza um escritor
     */
    public function update(Writer $writer, array $data): Writer
    {
        $writer->update($data);
        return $writer->fresh();
    }

    /**
     * Remove um escritor
     */
    public function delete(Writer $writer): bool
    {
        return $writer->delete();
    }

    /**
     * Busca um escritor por ID
     */
    public function findById(int $id): ?Writer
    {
        return Writer::find($id);
    }
}

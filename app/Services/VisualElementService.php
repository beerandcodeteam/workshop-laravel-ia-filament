<?php

namespace App\Services;

use App\Models\VisualElement;
use Illuminate\Database\Eloquent\Collection;

class VisualElementService
{
    /**
     * Lista todos os elementos visuais
     */
    public function list(): Collection
    {
        return VisualElement::all();
    }

    /**
     * Cria um novo elemento visual
     */
    public function create(array $data): VisualElement
    {
        return VisualElement::create($data);
    }

    /**
     * Atualiza um elemento visual
     */
    public function update(VisualElement $visualElement, array $data): VisualElement
    {
        $visualElement->update($data);
        return $visualElement->fresh();
    }

    /**
     * Remove um elemento visual
     */
    public function delete(VisualElement $visualElement): bool
    {
        return $visualElement->delete();
    }

    /**
     * Busca um elemento visual por ID
     */
    public function findById(int $id): ?VisualElement
    {
        return VisualElement::find($id);
    }
}

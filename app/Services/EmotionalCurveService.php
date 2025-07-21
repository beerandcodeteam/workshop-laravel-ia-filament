<?php

namespace App\Services;

use App\Models\EmotionalCurve;
use Illuminate\Database\Eloquent\Collection;

class EmotionalCurveService
{
    /**
     * Lista todas as curvas emocionais
     */
    public function list(): Collection
    {
        return EmotionalCurve::all();
    }

    /**
     * Cria uma nova curva emocional
     */
    public function create(array $data): EmotionalCurve
    {
        return EmotionalCurve::create($data);
    }

    /**
     * Atualiza uma curva emocional
     */
    public function update(EmotionalCurve $emotionalCurve, array $data): EmotionalCurve
    {
        $emotionalCurve->update($data);
        return $emotionalCurve->fresh();
    }

    /**
     * Remove uma curva emocional
     */
    public function delete(EmotionalCurve $emotionalCurve): bool
    {
        return $emotionalCurve->delete();
    }

    /**
     * Busca uma curva emocional por ID
     */
    public function findById(int $id): ?EmotionalCurve
    {
        return EmotionalCurve::find($id);
    }
}

<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Lista todos os usuários
     */
    public function list(): Collection
    {
        return User::all();
    }

    /**
     * Cria um novo usuário
     */
    public function create(array $data): User
    {
        // Hash da senha se fornecida
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return User::create($data);
    }

    /**
     * Atualiza um usuário
     */
    public function update(User $user, array $data): User
    {
        // Hash da senha se fornecida
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);
        return $user->fresh();
    }

    /**
     * Remove um usuário
     */
    public function delete(User $user): bool
    {
        return $user->delete();
    }

    /**
     * Busca um usuário por ID
     */
    public function findById(int $id): ?User
    {
        return User::find($id);
    }
}

<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return Gate::allows('is_admin');
    }

    /**
     * Determina se o usuário logado pode ver o perfil de outro usuário.
     */
    public function view(User $user, User $model): bool
    {
        // Exemplo: Qualquer um pode ver o perfil de qualquer um
        return $user->id === $model->id;
    }

    /**
     * Determina se o usuário logado pode editar o perfil do alvo.
     */
    public function update(User $user, User $model): bool
    {
        // O usuário logado ($user) só pode editar se ele for o próprio dono do perfil ($model)
        // Ou se ele for um administrador
        return $user->id === $model->id || Gate::allows('is_admin');
    }

    /**
     * Determina se o usuário logado pode deletar o perfil do alvo.
     */
    public function delete(User $user, User $model): bool
    {
        // Regra: Apenas o próprio usuário pode deletar sua conta
        return $user->id === $model->id;
    }
}

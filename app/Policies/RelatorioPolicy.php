<?php

namespace App\Policies;

use App\Models\Relatorio;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class RelatorioPolicy
{
    public function before(User $user): ?bool
    {
        if ($user->can('is_admin')) {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return Gate::allows('is_admin') || Gate::allows('is_professional');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Relatorio $relatorio): bool
    {
        return $user->id === $relatorio->servico->pedido->user_id || $user->id === $relatorio->servico->pedido->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return Gate::allows('is_professional');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Relatorio $relatorio): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Relatorio $relatorio): bool
    {
        return Gate::allows('is_professional');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Relatorio $relatorio): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Relatorio $relatorio): bool
    {
        return false;
    }
}

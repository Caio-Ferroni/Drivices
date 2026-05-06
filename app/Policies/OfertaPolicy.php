<?php

namespace App\Policies;

use App\Models\Oferta;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;

class OfertaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return Gate::allows('is_admin');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Oferta $oferta): bool
    {
        return $user->id === $oferta->pedido->user_id || $user->id === $oferta->professional->user_id;
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
    public function update(User $user, Oferta $oferta): bool
    {
        return $user->id === $oferta->professional->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Oferta $oferta): bool
    {
        return $user->id === $oferta->professional->user_id && $oferta->status =! "Aceito";
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Oferta $oferta): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Oferta $oferta): bool
    {
        return false;
    }

    public function aceitarOferta(User $user, Oferta $oferta): bool
    {
        return $user->id === $oferta->pedido->$user_id;
    }
}

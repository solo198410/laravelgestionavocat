<?php

namespace App\Policies;

use App\Affaire;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AffairePolicy
{
    use HandlesAuthorization;


    public function before($user, $ability) {
        if ($user->is_admin and $ability != 'delete') {
            return true;
        }
    }
    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Affaire  $affaire
     * @return mixed
     */
    public function view(User $user, Affaire $affaire)
    {
        return true;//return $user->id === $affaire->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Affaire  $affaire
     * @return mixed
     */
    public function update(User $user, Affaire $affaire)
    {
        return $user->id === $affaire->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Affaire  $affaire
     * @return mixed
     */
    public function delete(User $user, Affaire $affaire)
    {
        return $user->id === $affaire->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Affaire  $affaire
     * @return mixed
     */
    public function restore(User $user, Affaire $affaire)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Affaire  $affaire
     * @return mixed
     */
    public function forceDelete(User $user, Affaire $affaire)
    {
        //
    }
}

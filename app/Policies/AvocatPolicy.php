<?php

namespace App\Policies;

use App\Avocat;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AvocatPolicy
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
     * @param  \App\Avocat  $avocat
     * @return mixed
     */
    public function view(User $user, Avocat $avocat)
    {
        return true;
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
     * @param  \App\Avocat  $avocat
     * @return mixed
     */
    public function update(User $user, Avocat $avocat)
    {
        return $user->id === $avocat->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Avocat  $avocat
     * @return mixed
     */
    public function delete(User $user, Avocat $avocat)
    {
        return $user->id === $avocat->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Avocat  $avocat
     * @return mixed
     */
    public function restore(User $user, Avocat $avocat)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Avocat  $avocat
     * @return mixed
     */
    public function forceDelete(User $user, Avocat $avocat)
    {
        //
    }
}

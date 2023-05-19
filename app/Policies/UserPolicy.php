<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Users\Models\Users;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \Users\Models\Users  $users
     * @return mixed
     */
    public function viewAny(Users $users)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \Users\Models\Users  $users
     * @param  \App\Users  $userss
     * @return mixed
     */
    public function view(Users $users)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \Users\Models\Users  $users
     * @return mixed
     */
    public function create(Users $users)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \Users\Models\Users  $users
     * @param  \App\Users  $userss
     * @return mixed
     */
    public function update(Users $users, Users $userss)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \Users\Models\Users  $users
     * @param  \App\Users  $userss
     * @return mixed
     */
    public function delete(Users $users, Users $userss)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \Users\Models\Users  $users
     * @param  \App\Users  $userss
     * @return mixed
     */
    public function restore(Users $users, Users $userss)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \Users\Models\Users  $users
     * @param  \App\Users  $userss
     * @return mixed
     */
    public function forceDelete(Users $users, Users $userss)
    {
        //
    }
}

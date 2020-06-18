<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy extends ModelPolicy
{
    /**
     * Determine whether the user can change password.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function change(User $user)
    {
        return $this->service->hasPermission($user, 'password-change');
    }

    /**
     * Determine whether the user can reset password.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function reset(User $user)
    {
        return $this->service->hasPermission($user, 'password-reset');
    }

    /**
     * Determine whether the user can assign role.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function role(User $user)
    {
        return $this->service->hasPermission($user, 'role-assign');
    }

    /**
     * Determine whether the user can assign group.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function group(User $user)
    {
        return $this->service->hasPermission($user, 'group-assign');
    }

    /**
     * Determine whether the user can import users.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function import(User $user)
    {
        return $this->service->hasPermission($user, 'user-import');
    }

    /**
     * Determine whether the user can draw groups.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function draw(User $user)
    {
        return $this->service->hasPermission($user, 'user-draw');
    }
}

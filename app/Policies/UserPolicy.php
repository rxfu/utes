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
        return $this->service->hasPermission($user, 'user-change');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function reset(User $user)
    {
        return $this->service->hasPermission($user, 'user-reset');
    }
}

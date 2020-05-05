<?php

namespace App\Policies;

use App\Models\User;

class RolePolicy extends ModelPolicy
{
    /**
     * Determine whether the role can grant permission.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function grant(User $user)
    {
        return $this->service->hasPermission($user, 'permission-grant');
    }
}

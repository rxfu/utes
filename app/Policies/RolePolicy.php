<?php

namespace App\Policies;

use App\Models\User;

class RolePolicy extends ModelPolicy
{
    /**
     * Determine whether the role can assign permission.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function permission(User $user)
    {
        return $this->service->hasPermission($user, 'permission-assign');
    }
}

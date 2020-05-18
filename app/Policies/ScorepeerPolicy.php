<?php

namespace App\Policies;

use App\Models\User;

class ScorepeerPolicy extends ModelPolicy
{
    /**
     * Determine whether the user can list assigned teachers.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function teacher(User $user)
    {
        return $this->service->hasPermission($user, 'scorepeer-teachers');
    }
}

<?php

namespace App\Policies;

use App\Models\User;

class ApplicationPolicy extends ModelPolicy
{
    /**
     * Determine whether the user can audit teachers.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function audit(User $user)
    {
        return $this->service->hasPermission($user, 'application-audit');
    }
}

<?php

namespace App\Policies;

use App\Models\User;

class ScorePolicy extends ModelPolicy
{
    /**
     * Determine whether the user can import scores.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function import(User $user)
    {
        return $this->service->hasPermission($user, 'score-import');
    }

    /**
     * Determine whether the user can import scores.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function export(User $user)
    {
        return $this->service->hasPermission($user, 'score-export');
    }

    /**
     * Determine whether the user can rank scores.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function rank(User $user)
    {
        return $this->service->hasPermission($user, 'score-rank');
    }
}

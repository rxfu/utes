<?php

namespace App\Repositories;

use App\Models\User;
use App\Exceptions\InternalException;
use Illuminate\Database\QueryException;

class UserRepository extends Repository
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function authenticate($user, $permission)
    {
        try {
            foreach ($permission->roles as $role) {
                if ($user->roles->contains($role)) {
                    return true;
                }
            }

            return false;
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }
}

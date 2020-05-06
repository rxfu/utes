<?php

namespace App\Repositories;

use App\Models\User;
use App\Exceptions\InternalException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\QueryException;

class UserRepository extends Repository
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function roles($user)
    {
        $roles = Cache::rememberForever($user->username . '.role', function () use ($user) {
            return $user->roles;
        });

        return $roles;
    }

    public function authenticate($user, $permission)
    {
        if (empty($permission)) {
            return false;
        }

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

    public function grant($user, $roles)
    {
        try {
            $user->roles()->sync($roles);
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }
}

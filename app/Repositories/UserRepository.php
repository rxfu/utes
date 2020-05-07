<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\User;
use App\Exceptions\InternalException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository extends Repository
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function roles($user)
    {
        $roles = Cache::rememberForever($user->username . '.roles', function () use ($user) {
            return $user->roles->pluck('slug')->toArray();
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

            Cache::forget($user->username . '.roles');
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }

    public function super($id)
    {
        try {
            $user = $this->find($id);

            return $user->is_super;
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }

    public function logLoginTime($id)
    {
        try {
            $data = [
                'last_login_at' => Carbon::now(),
            ];

            return $this->update($id, $data);
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }

    public function active($username)
    {
        try {
            $user = $this->model->whereUsername($username)->firstOrFail();

            return $user->is_enable;
        } catch (ModelNotFoundException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }
}

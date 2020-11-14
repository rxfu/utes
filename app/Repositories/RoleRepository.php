<?php

namespace App\Repositories;

use App\Models\Role;
use Illuminate\Support\Arr;
use App\Exceptions\InternalException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\QueryException;

class RoleRepository extends Repository
{
    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    public function permissions($roles)
    {
        $permissions = array_map(function ($role) {
            $permissions = Cache::rememberForever($role . '.permissions', function () use ($role) {
                return $this->model->whereSlug($role)->first()->permissions->pluck('slug')->toArray();
            });

            return $permissions;
        }, $roles);

        return array_unique(Arr::flatten($permissions));
    }

    public function assign($role, $permissions)
    {
        try {
            $role->permissions()->sync($permissions);

            Cache::forget($role->slug . '.permissions');
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }

    public function users($role)
    {
        try {
            $role = $this->model->with('users', 'users.groups', 'users.application', 'users.department', 'users.gender', 'users.application.appliedTitle')
                ->whereSlug($role)
                ->firstOrFail();

            return $role->users;
        } catch (ModelNotFoundException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }
}

<?php

namespace App\Services;

use App\Repositories\RoleRepository;

class RoleService extends Service
{
    public function __construct(RoleRepository $roles)
    {
        $this->repository = $roles;
    }

    public function getAll()
    {
        return $this->repository->findWith(['permissions']);
    }

    public function assignPermission($role, $permissions)
    {
        $role = $this->repository->find($role->getKey());

        $this->repository->grant($role, $permissions);
    }

    public function getGrantedPermissions($role)
    {
        $role = $this->repository->find($role->getKey());

        return $role->permissions->pluck('id')->toArray();
    }
}

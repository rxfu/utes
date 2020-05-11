<?php

namespace App\Services;

use App\Repositories\PermissionRepository;

class PermissionService extends Service
{
    public function __construct(PermissionRepository $permissions)
    {
        $this->repository = $permissions;
    }

    public function getAll()
    {
        return $this->repository->findWith(['roles']);
    }
}

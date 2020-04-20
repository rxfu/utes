<?php

namespace App\Services;

use App\Repositories\RoleRepository;

class RoleService extends Service
{
    public function __construct(RoleRepository $roles)
    {
        $this->repository = $roles;
    }
}

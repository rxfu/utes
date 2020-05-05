<?php

namespace App\Repositories;

use App\Models\Role;
use App\Exceptions\InternalException;
use Illuminate\Database\QueryException;

class RoleRepository extends Repository
{
    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    public function grant($role, $permissions)
    {
        try {
            $role->permissions()->sync($permissions);
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }
}

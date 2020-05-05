<?php

namespace App\Repositories;

use App\Models\Permission;
use App\Exceptions\InvalidRequestException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PermissionRepository extends Repository
{
    public function __construct(Permission $permission)
    {
        $this->model = $permission;
    }

    public function have($slug)
    {
        return $this->model->whereSlug($slug)->first();
    }
}

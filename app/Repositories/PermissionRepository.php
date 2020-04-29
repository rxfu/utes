<?php

namespace App\Repositories;

use App\Models\Permission;
use App\Exceptions\InternalException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PermissionRepository extends Repository
{
    public function __construct(Permission $permission)
    {
        $this->model = $permission;
    }

    public function own($slug)
    {
        try {
            return $this->model->whereSlug($slug)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }
}

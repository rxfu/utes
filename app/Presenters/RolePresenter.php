<?php

namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class RolePresenter extends Presenter
{
    public function byGroup()
    {
        return $this->by_group ? '是' : '否';
    }

    public function hasPermissions()
    {
        $permissions = [];

        foreach ($this->permissions as $permission) {
            $permissions[] = $permission->name;
        }

        return implode(',', $permissions);
    }
}

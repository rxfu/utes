<?php

namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class PermissionPresenter extends Presenter
{
    public function hasRoles()
    {
        $roles = [];

        foreach ($this->roles as $role) {
            $roles[] = $role->name;
        }

        return implode(',', $roles);
    }
}

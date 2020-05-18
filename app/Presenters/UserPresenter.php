<?php

namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter
{
    public function isEnable()
    {
        return $this->is_enable ? '是' : '否';
    }

    public function isSuper()
    {
        return $this->is_super ? '是' : '否';
    }

    public function allRoles()
    {
        $roles = [];

        foreach ($this->roles as $role) {
            $roles[] = $role->name;
        }

        return implode(',', $roles);
    }

    public function allGroups()
    {
        $groups = [];

        foreach ($this->groups as $group) {
            $groups[] = $group->name;
        }

        return implode(',', $groups);
    }

    public function allTeachers()
    {
        $teachers = [];

        foreach ($this->teachers->groupBy('id') as $teacher) {
            $teachers[] = $teacher[0]->name;
        }

        return implode(',', $teachers);
    }
}

<?php

namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class PermissionPresenter extends Presenter
{
    public function byGroup()
    {
        return $this->by_group ? '是' : '否';
    }
}

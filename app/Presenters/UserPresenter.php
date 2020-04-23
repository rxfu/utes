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
}

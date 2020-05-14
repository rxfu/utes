<?php

namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class TitlePresenter extends Presenter
{
    public function isAllowed()
    {
        return $this->is_allowed ? '是' : '否';
    }
}

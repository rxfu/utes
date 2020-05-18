<?php

namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class ScorepeerPresenter extends Presenter
{
    public function isConfirmed()
    {
        return $this->is_confirmed ? '已确认' : '未确认';
    }
}

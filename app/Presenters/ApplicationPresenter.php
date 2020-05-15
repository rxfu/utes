<?php

namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class ApplicationPresenter extends Presenter
{
    public function isAppliedPeer()
    {
        return $this->is_applied_peer ? '是' : '否';
    }
}

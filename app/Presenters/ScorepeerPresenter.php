<?php

namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class ScorepeerPresenter extends Presenter
{
    public function isConfirmed()
    {
        return $this->is_confirmed ? '已确认' : '未确认';
    }

    public function image()
    {
        if ($this->file) {
            return '<a href="' . asset('storage/' . $this->file) . '"><img src="' . asset('storage/' . $this->file) . '" class="img-thumbnail"></a>';
        }

        return null;
    }
}

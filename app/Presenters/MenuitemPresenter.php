<?php

namespace App\Presenters;

use Illuminate\Support\Str;
use Laracasts\Presenter\Presenter;

class MenuitemPresenter extends Presenter
{
    public function link()
    {
        return Str::of($this->route)->trim()->isEmpty() ? '#' : route($this->route);
    }
}

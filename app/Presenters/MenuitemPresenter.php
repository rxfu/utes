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

    public function isEnable()
    {
        return $this->is_enable ? '是' : '否';
    }

    public function image()
    {
        $icon = '<i class="nav-icon ';

        if (Str::of($this->icon)->trim()->isEmpty()) {
            $icon .= 'far fa-circle';
        } else {
            $icon .= 'fas fa-' . $this->icon;
        }

        $icon .= '"></i>';

        return $icon;
    }
}

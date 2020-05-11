<?php

namespace App\Traits;

trait Flash
{
    private function _flash($type, $code)
    {
        $message = config('setting.code')[(int) $code];
        $message = '[' . $code . '] ' . $message;

        session()->flash($type, $message);
    }

    public function success($code)
    {
        $this->_flash('success', $code);
    }

    public function error($code)
    {
        $this->_flash('danger', $code);
    }

    public function warning($code)
    {
        $this->_flash('warning', $code);
    }

    public function info($code)
    {
        $this->_flash('info', $code);
    }
}

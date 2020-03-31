<?php

namespace App\Repositories;

class BaseRepository
{
    protected $model;

    public static function __callStatic($method, $arguments)
    {
        return call_user_func_array([new static(), $method], $arguments);
    }

    public function __call($method, $arguments)
    {
        return call_user_func_array([$this->model, $method], $arguments);
    }
}

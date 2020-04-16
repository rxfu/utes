<?php

namespace App\Repositories;

use App\Exceptions\InternalException;
use App\Models\Menu;
use Illuminate\Database\QueryException;

class MenuRepository extends Repository
{
    public function __construct(Menu $menu)
    {
        $this->model = $menu;
    }

    public function getActiveItems($uid)
    {
        try {
            return $this->model->isActive($uid)->first()->activeItems()->get();
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), 'getActiveItems');
        }
    }
}

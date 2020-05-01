<?php

namespace App\Repositories;

use App\Models\Menuitem;

class MenuitemRepository extends Repository
{
    public function __construct(Menuitem $menuitem)
    {
        $this->model = $menuitem;
    }

    public function getItemsByParent($id = null)
    {
        return $this->model->whereParentId($id)->get();
    }

    public function getActiveItems($menu)
    {
        return $this->model->whereMenuId($menu->id)->get();
    }
}

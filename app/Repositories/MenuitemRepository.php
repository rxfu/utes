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

    public function activeItems($menuId)
    {
        return $this->model->enable($menuId)
            ->orderBy('parent_id')
            ->orderBy('order')
            ->get();
    }
}

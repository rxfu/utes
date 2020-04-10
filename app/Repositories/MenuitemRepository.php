<?php

namespace App\Repositories;

use App\Models\Menuitem;

class MenuitemRepository extends Repository
{
    public function __construct(Menuitem $menuitem)
    {
        $this->model = $menuitem;
    }
}

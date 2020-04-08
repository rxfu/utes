<?php

namespace App\Services;

use App\Repositories\MenuRepository;

class MenuService extends Service
{
    public function __construct(MenuRepository $menus)
    {
        $this->repository = $menus;
    }
}

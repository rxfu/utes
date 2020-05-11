<?php

namespace App\Services;

use App\Repositories\MenuitemRepository;
use App\Repositories\MenuRepository;
use App\Repositories\UserRepository;

class MenuService extends Service
{
    protected $users;

    protected $menuitems;

    public function __construct(MenuRepository $menus, UserRepository $users, MenuitemRepository $menuitems)
    {
        $this->repository = $menus;
        $this->users = $users;
        $this->menuitems = $menuitems;
    }
}

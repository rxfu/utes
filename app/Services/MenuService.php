<?php

namespace App\Services;

use App\Repositories\MenuRepository;
use App\Repositories\UserRepository;

class MenuService extends Service
{
    protected $users;

    public function __construct(MenuRepository $menus, UserRepository $users)
    {
        $this->repository = $menus;
        $this->users = $users;
    }

    public function getItemsByMenu($slug, $enable = true)
    {
        $menu = $this->repository->getMenu($slug, $enable);
    }
}

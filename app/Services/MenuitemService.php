<?php

namespace App\Services;

use App\Repositories\MenuitemRepository;
use App\Repositories\MenuRepository;

class MenuitemService extends Service
{
    protected $menus;

    public function __construct(MenuitemRepository $menuitems, MenuRepository $menus)
    {
        $this->repository = $menuitems;
        $this->menus = $menus;
    }

    public function getAll()
    {
        return $this->repository->findWith(['parent', 'menu']);
    }

    public function getLevel1Items()
    {
        return $this->repository->getItemsByParent();
    }

    public function getActiveByMenu($slug)
    {
        $menu = $this->menus->activeItem($slug);
        $items = $this->repository->activeItems($menu->id);

        foreach ($items as $item) {
        }
    }
}

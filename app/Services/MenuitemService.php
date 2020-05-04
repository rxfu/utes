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

        $tree = [];
        foreach ($items as $item) {
            $node = [
                'id' => $item->id,
                'name' => $item->name,
                'url' => $item->present()->link,
                'icon' => $item->present()->image,
            ];

            if (!empty($item->parent_id) && isset($tree[$item->parent_id])) {
                $tree[$item->parent_id]['children'][] = $node;
            } else {
                $tree[$item->id] = $node;
            }
        }

        return $tree;
    }
}

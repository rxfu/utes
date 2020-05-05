<?php

namespace App\Services;

use App\Repositories\MenuRepository;
use Illuminate\Support\Facades\Auth;
use App\Repositories\MenuitemRepository;

class MenuitemService extends Service
{
    protected $menus;

    protected $userService;

    public function __construct(MenuitemRepository $menuitems, MenuRepository $menus, UserService $userService)
    {
        $this->repository = $menuitems;
        $this->menus = $menus;
        $this->userService = $userService;
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
            if ($this->userService->hasPermission(Auth::user(), $this->getPermission($item->route))) {
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
        }
        dd($tree);
        return $tree;
    }

    public function getPermission($route)
    {
        return str_replace('.', '-', $route);
    }
}

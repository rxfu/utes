<?php

namespace App\Services;

use Illuminate\Support\Str;
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

        $menuitems = [];
        foreach ($items as $item) {
            if (empty($item->route) || $this->userService->hasPermission(Auth::user(), $this->getPermission($item->route))) {
                $node = [
                    'id' => $item->id,
                    'name' => $item->name,
                    'url' => $item->present()->link,
                    'icon' => $item->present()->image,
                ];

                if (!empty($item->parent_id) && isset($menuitems[$item->parent_id])) {
                    $menuitems[$item->parent_id]['children'][] = $node;
                } else {
                    $menuitems[$item->id] = $node;
                }
            }
        }

        foreach ($menuitems as $key => $item) {
            if (!isset($item['children']) && ('#' === $item['url'])) {
                unset($menuitems[$key]);
            }
        }

        return $menuitems;
    }

    public function getPermission($route)
    {
        if (strpos($route, '.')) {
            list($model, $action) = explode('.', $route);
            $model = Str::singular($model);

            return $model . '-' . $action;
        }

        return $route;
    }
}

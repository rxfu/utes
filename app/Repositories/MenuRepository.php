<?php

namespace App\Repositories;

use App\Models\Menu;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MenuRepository extends BaseRepository
{
    public function __construct(Menu $menu)
    {
        $this->model = $menu;
    }

    public function getMenu($uid)
    {
        try {
            return $this->model->whereUid($uid)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            session()->flash('danger', '没有 ' . $uid . ' 菜单');
        }
    }
}

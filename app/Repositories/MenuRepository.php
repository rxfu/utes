<?php

namespace App\Repositories;

use App\Exceptions\InternalException;
use App\Models\Menu;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class MenuRepository extends BaseRepository
{
    public function __construct(Menu $menu)
    {
        $this->model = $menu;
    }

    public function getActiveItems($uid)
    {
        try {
            return $this->model->isActive($uid)->firstOrFail()->activeItems()->get();
        } catch (QueryException $e) {
            throw new InternalException($e);
        } catch (ModelNotFoundException $e) {
            throw new InternalException($e);
        }
    }
}

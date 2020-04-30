<?php

namespace App\Repositories;

use App\Models\Menu;
use App\Exceptions\InternalException;
use Illuminate\Database\QueryException;
use App\Exceptions\InvalidRequestException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MenuRepository extends Repository
{
    public function __construct(Menu $menu)
    {
        $this->model = $menu;
    }

    public function getMenu($slug, $enable = true)
    {
        try {
            return $this->model->whereSlug($slug)->enable($enable)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            throw new InvalidRequestException(500004, $this->getModel(), __FUNCTION__);
        }
    }

    public function getActiveItems($slug)
    {
        try {
            return $this->model->isActive($slug)->first()->activeItems()->get();
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }
}

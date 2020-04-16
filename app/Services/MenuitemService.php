<?php

namespace App\Services;

use App\Repositories\MenuitemRepository;

class MenuitemService extends Service
{
    public function __construct(MenuitemRepository $menuitems)
    {
        $this->repository = $menuitems;
    }

    public function getAll() {
        return $this->repository->findWith(['parent', 'menu']);
    }

    public function getLevel1Items() {
        return $this->repository->getItemsByParent();
    }
}

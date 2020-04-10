<?php

namespace App\Services;

use App\Repositories\MenuitemRepository;

class MenuitemService extends Service
{
    public function __construct(MenuitemRepository $menuitems)
    {
        $this->repository = $menuitems;
    }
}

<?php

namespace App\Services;

use App\Repositories\GroupRepository;

class GroupService extends Service
{
    public function __construct(GroupRepository $groups)
    {
        $this->repository = $groups;
    }
}

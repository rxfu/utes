<?php

namespace App\Services;

use {{ namespacedRepository }};

class MenuService extends Service
{
    public function __construct({{ repository }} ${{ repositoryVariable }})
    {
        $this->repository = ${{ repositoryVariable }};
    }
}

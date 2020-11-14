<?php

namespace App\Services;

use App\Repositories\DegreeRepository;

class DegreeService extends Service
{
    public function __construct(DegreeRepository $degrees)
    {
        $this->repository = $degrees;
    }
}

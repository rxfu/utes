<?php

namespace App\Services;

use App\Repositories\ScorepeerRepository;

class ScorepeerService extends Service
{
    public function __construct(ScorepeerRepository $scorepeers)
    {
        $this->repository = $scorepeers;
    }
}

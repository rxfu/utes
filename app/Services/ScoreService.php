<?php

namespace App\Services;

use App\Repositories\ScoreRepository;

class ScoreService extends Service
{
    public function __construct(ScoreRepository $scores)
    {
        $this->repository = $scores;
    }
}

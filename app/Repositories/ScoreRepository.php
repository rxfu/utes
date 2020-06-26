<?php

namespace App\Repositories;

use App\Models\Score;

class ScoreRepository extends Repository
{
    public function __construct(Score $score)
    {
        $this->model = $score;
    }
}

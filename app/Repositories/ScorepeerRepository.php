<?php

namespace App\Repositories;

use App\Models\Scorepeer;

class ScorepeerRepository extends Repository
{
    public function __construct(Scorepeer $scorepeer)
    {
        $this->model = $scorepeer;
    }
}

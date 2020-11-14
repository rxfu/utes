<?php

namespace App\Repositories;

use App\Models\Degree;

class DegreeRepository extends Repository
{
    public function __construct(Degree $degree)
    {
        $this->model = $degree;
    }
}

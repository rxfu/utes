<?php

namespace App\Repositories;

use App\Models\Grade;

class GradeRepository extends Repository
{
    public function __construct(Grade $grade)
    {
        $this->model = $grade;
    }
}

<?php

namespace App\Services;

use App\Repositories\GradeRepository;

class GradeService extends Service
{
    public function __construct(GradeRepository $grades)
    {
        $this->repository = $grades;
    }
}

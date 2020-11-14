<?php

namespace App\Services;

use App\Repositories\SubjectRepository;

class SubjectService extends Service
{
    public function __construct(SubjectRepository $subjects)
    {
        $this->repository = $subjects;
    }
}

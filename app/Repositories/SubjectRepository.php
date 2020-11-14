<?php

namespace App\Repositories;

use App\Models\Subject;

class SubjectRepository extends Repository
{
    public function __construct(Subject $subject)
    {
        $this->model = $subject;
    }
}

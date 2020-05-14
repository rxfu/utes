<?php

namespace App\Repositories;

use App\Models\Gender;

class GenderRepository extends Repository
{
    public function __construct(Gender $gender)
    {
        $this->model = $gender;
    }
}

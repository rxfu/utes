<?php

namespace App\Repositories;

use App\Models\Application;

class ApplicationRepository extends Repository
{
    public function __construct(Application $application)
    {
        $this->model = $application;
    }
}

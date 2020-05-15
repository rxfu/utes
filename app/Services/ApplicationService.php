<?php

namespace App\Services;

use App\Repositories\ApplicationRepository;

class ApplicationService extends Service
{
    public function __construct(ApplicationRepository $applications)
    {
        $this->repository = $applications;
    }
}

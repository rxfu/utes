<?php

namespace App\Services;

use App\Repositories\ApplicationRepository;

class ApplicationService extends Service
{
    public function __construct(ApplicationRepository $applications)
    {
        $this->repository = $applications;
    }

    public function getAll()
    {
        return $this->repository->findWith(['user', 'gender', 'department', 'title', 'appliedTitle']);
    }
}

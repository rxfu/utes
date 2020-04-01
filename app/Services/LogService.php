<?php

namespace App\Services;

use App\Repositories\LogRepository;

class LogService extends Service
{
    public function __construct(LogRepository $logs)
    {
        $this->repository = $logs;
    }
}

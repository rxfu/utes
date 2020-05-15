<?php

namespace App\Services;

use App\Repositories\TitleRepository;

class TitleService extends Service
{
    public function __construct(TitleRepository $titles)
    {
        $this->repository = $titles;
    }

    public function getAppliedTitles()
    {
        return $this->repository->allowed();
    }
}

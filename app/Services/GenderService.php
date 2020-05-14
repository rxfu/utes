<?php

namespace App\Services;

use App\Repositories\GenderRepository;

class GenderService extends Service
{
    public function __construct(GenderRepository $genders)
    {
        $this->repository = $genders;
    }
}

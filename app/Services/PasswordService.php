<?php

namespace App\Services;

use App\Repositories\PasswordRepository;

class PasswordService extends Service
{
    public function __construct(PasswordRepository $passwords)
    {
        $this->repository = $passwords;
    }
}

<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService extends Service
{
    public function __construct(UserRepository $users)
    {
        $this->repository = $users;
    }
}

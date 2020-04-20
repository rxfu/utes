<?php

namespace App\Repositories;

use App\Models\Password;

class PasswordRepository extends Repository
{
    public function __construct(Password $password)
    {
        $this->model = $password;
    }
}

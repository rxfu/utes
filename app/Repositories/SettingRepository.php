<?php

namespace App\Repositories;

use App\Models\Setting;

class SettingRepository extends Repository
{
    public function __construct(Setting $setting)
    {
        $this->model = $setting;
    }
}

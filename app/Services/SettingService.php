<?php

namespace App\Services;

use App\Repositories\SettingRepository;

class SettingService extends Service
{
    public function __construct(SettingRepository $settings)
    {
        $this->repository = $settings;
    }

    public function getSetting($name)
    {
        $value = $this->repository->item($name)->value;

        return $value;
    }
}

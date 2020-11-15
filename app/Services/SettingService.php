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
        $setting = $this->repository->item($name);

        return empty($setting) ? null : $setting->value;
    }
}

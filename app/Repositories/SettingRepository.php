<?php

namespace App\Repositories;

use App\Models\Setting;
use App\Exceptions\InternalException;
use Illuminate\Database\QueryException;

class SettingRepository extends Repository
{
    public function __construct(Setting $setting)
    {
        $this->model = $setting;
    }

    public function item($name)
    {
        try {
            return $this->model->whereName($name)->first();
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }
}

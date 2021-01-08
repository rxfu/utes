<?php

namespace App\Repositories;

use App\Models\Application;
use App\Exceptions\InternalException;
use Illuminate\Database\QueryException;

class ApplicationRepository extends Repository
{
    public function __construct(Application $application)
    {
        $this->model = $application;
    }

    public function years()
    {
        try {
            return $this->model->distinct()->select('year')->get();
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }
}

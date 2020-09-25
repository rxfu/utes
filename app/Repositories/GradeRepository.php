<?php

namespace App\Repositories;

use App\Models\Grade;
use App\Exceptions\InternalException;
use Illuminate\Database\QueryException;

class GradeRepository extends Repository
{
    public function __construct(Grade $grade)
    {
        $this->model = $grade;
    }

    public function grade($score)
    {
        try {
            return $this->model->where('min_score', '<=', $score)
                ->where('max_score', '>=', $score)
                ->first();
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }
}

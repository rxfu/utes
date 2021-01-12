<?php

namespace App\Repositories;

use App\Models\Score;
use App\Exceptions\InternalException;
use Illuminate\Database\QueryException;

class ScoreRepository extends Repository
{
    public function __construct(Score $score)
    {
        $this->model = $score;
    }

    public function years()
    {
        try {
            return $this->model->distinct()->select('year')->orderBy('year', 'desc')->get();
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }
}

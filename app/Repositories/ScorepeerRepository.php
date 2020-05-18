<?php

namespace App\Repositories;

use App\Models\Scorepeer;
use App\Exceptions\InternalException;
use Illuminate\Database\QueryException;

class ScorepeerRepository extends Repository
{
    public function __construct(Scorepeer $scorepeer)
    {
        $this->model = $scorepeer;
    }

    public function teachers($userId)
    {
        try {
            $teachers = $this->model->whereJudgeId($userId)->get();

            return $teachers->pluck('user_id')->toArray();
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }

    public function assignTeacher($user, $teachers)
    {
        try {
            $result = $user->teachers()->sync($teachers);
            $attached = array_combine(array_values($result['attached']), array_fill(0, count($result['attached']), head($teachers)));

            for ($i = 0; $i < 2; ++$i) {
                $user->teachers()->attach($attached);
            }
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }
}

<?php

namespace App\Repositories;

use App\Models\Group;
use App\Exceptions\InternalException;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;

class GroupRepository extends Repository
{
    public function __construct(Group $group)
    {
        $this->model = $group;
    }

    public function countUsers($isDrawed = false)
    {
        try {
            return $this->model->withCount(['users' => function (Builder $query) use ($isDrawed) {
                $query->whereIsDrawed($isDrawed);
            }])->lockForUpdate()->get();
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }

    public function getSeqs($groupId)
    {
        try {
            $group = $this->find($groupId);

            $seqs = [];
            foreach ($group->users()->lockForUpdate()->get() as $user) {
                $seqs[] = $user->pivot->seq;
            }

            return $seqs;
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }
}

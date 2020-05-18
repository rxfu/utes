<?php

namespace App\Services;

use App\Repositories\ScorepeerRepository;
use App\Repositories\SettingRepository;
use App\Repositories\UserRepository;

class ScorepeerService extends Service
{
    protected $users;

    protected $settings;

    public function __construct(ScorepeerRepository $scorepeers, UserRepository $users, SettingRepository $settings)
    {
        $this->repository = $scorepeers;
        $this->users = $users;
        $this->settings = $settings;
    }

    public function getAll()
    {
        return $this->repository->findWith(['judge', 'user']);
    }

    public function getAssignedTeachers($user)
    {
        return $this->repository->teachers($user->getKey());
    }

    public function assignTeacher($user, $teachers)
    {
        $user = $this->users->find($user->getKey());
        $year = $this->settings->item('year')->value;
        $teachers = array_combine(array_values($teachers), array_fill(0, count($teachers), compact('year')));

        $this->repository->assignTeacher($user, $teachers);
    }
}

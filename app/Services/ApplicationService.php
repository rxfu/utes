<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ApplicationRepository;

class ApplicationService extends Service
{
    protected $userService;

    protected $settingService;

    public function __construct(ApplicationRepository $applications, UserService $userService, SettingService $settingService)
    {
        $this->repository = $applications;
        $this->userService = $userService;
        $this->settingService = $settingService;
    }

    public function getAll()
    {
        if ($this->userService->isSuperAdmin(Auth::user())) {
            return $this->repository->findWith(['user', 'user.gender', 'user.department', 'title', 'appliedTitle']);
        } else {
            return  $this->repository->findBy(['user_id' => Auth::id()], ['user', 'user.gender', 'user.department', 'title', 'appliedTitle']);
        }
    }

    public function getAllByYear($year)
    {
        return $this->repository->findBy(['year' => $year], ['user', 'user.gender', 'user.department', 'title', 'appliedTitle']);
    }

    public function getYears()
    {
        return $this->repository->years();
    }

    public function register($data)
    {
        foreach (range(1, 3) as $id) {
            if (isset($data['file' . $id])) {
                $files[$id] = $this->upload($data['file' . $id], $data['uid']);
            }
        }

        $user = $this->userService->store([
            'uid' => $data['uid'],
            'username' => $data['name'] . $data['uid'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'phone' => $data['phone'],
            'gender_id' => $data['gender_id'],
            'department_id' => $data['department_id'],
        ]);

        $this->userService->assignRole($user, 2);

        $file = isset($files) ? implode(';', Arr::pluck($files, 'path')) : null;

        $application = [
            'year' => $this->settingService->getSetting('year'),
            'user_id' => $user->id,
            'degree_id' => $data['degree_id'],
            'title_id' => $data['title_id'],
            'applied_title_id' => $data['applied_title_id'],
            'is_applied_expert' => $data['is_applied_expert'],
            'reason' => ($data['is_applied_expert'] == 1) ? 0 : $data['reason'],
            'has_course' => $data['has_course'],
            'course' => $data['course'],
            'subject_id' => $data['subject_id'],
            'remark' => $data['remark'],
            'file' => $file,
        ];

        $this->store($application);

        return $user;
    }

    public function amend($model, $data)
    {
        foreach (range(1, 3) as $id) {
            if (isset($data['file' . $id])) {
                $files[$id] = $this->upload($data['file' . $id], $data['uid']);
            }
        }

        $this->userService->update($model->user, [
            'uid' => $data['uid'],
            'username' => $data['name'] . $data['uid'],
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'gender_id' => $data['gender_id'],
            'department_id' => $data['department_id'],
        ]);

        $file = isset($files) ? implode(';', Arr::pluck($files, 'path')) : null;

        $application = [
            'degree_id' => $data['degree_id'],
            'title_id' => $data['title_id'],
            'applied_title_id' => $data['applied_title_id'],
            'is_applied_expert' => $data['is_applied_expert'],
            'reason' => ($data['is_applied_expert'] == 1) ? 0 : $data['reason'],
            'has_course' => $data['has_course'],
            'course' => $data['course'],
            'subject_id' => $data['subject_id'],
            'remark' => $data['remark'],
        ];

        if (!is_null($file)) {
            $application['file'] = $file;
        }

        $this->update($model, $application);
    }
}

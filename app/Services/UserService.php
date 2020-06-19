<?php

namespace App\Services;

use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\InvalidRequestException;
use App\Repositories\GroupRepository;
use Illuminate\Support\Facades\DB;

class UserService extends Service
{
    protected $roles;

    protected $groups;

    public function __construct(UserRepository $users, RoleRepository $roles, GroupRepository $groups)
    {
        $this->repository = $users;
        $this->roles = $roles;
        $this->groups = $groups;
    }

    public function getAll()
    {
        return $this->repository->findWith(['roles']);
    }

    public function changePassword($user, $oldPassword, $newPassword, $confirmedPassword)
    {
        $credentials = [
            'username' => $user->username,
            'password' => $oldPassword,
        ];

        if (Auth::attempt($credentials)) {
            if ($newPassword === $confirmedPassword) {
                try {
                    $this->repository->update($user->getKey(), ['password' => $newPassword]);
                } catch (InvalidRequestException $e) {
                    throw new InvalidRequestException(403002, $this->repository->getModel(), __FUNCTION__);
                }
            } else {
                throw new InvalidRequestException(403004, $this->repository->getModel(), __FUNCTION__);
            }
        } else {
            throw new InvalidRequestException(403003, $this->repository->getModel(), __FUNCTION__);
        }
    }

    public function resetPassword($user, $newPassword, $confirmedPassword)
    {
        if ($newPassword === $confirmedPassword) {
            try {
                $this->repository->update($user->getKey(), ['password' => $newPassword]);
            } catch (InvalidRequestException $e) {
                throw new InvalidRequestException(403001, $this->repository->getModel(), __FUNCTION__);
            }
        } else {
            throw new InvalidRequestException(403004, $this->repository->getModel(), __FUNCTION__);
        }
    }

    public function hasGroup($user, $groupId)
    {
        if ($this->isSuperAdmin($user) || is_null($groupId)) {
            return true;
        }

        $groups = $this->repository->groups($user);

        return in_array($groupId, $groups);
    }

    public function hasPermission($user, $permission)
    {
        if ($this->isSuperAdmin($user)) {
            return true;
        }

        $roles = $this->repository->roles($user);
        $permissions = $this->roles->permissions($roles);

        return in_array($permission, $permissions);
    }

    public function assignRole($user, $roles)
    {
        $user = $this->repository->find($user->getKey());

        $this->repository->assignRole($user, $roles);
    }

    public function getAssignedRoles($user)
    {
        $user = $this->repository->find($user->getKey());

        return $user->roles->pluck('id')->toArray();
    }

    public function assignGroup($user, $groups)
    {
        $user = $this->repository->find($user->getKey());

        $this->repository->assignGroup($user, $groups);
    }

    public function getAssignedGroups($user)
    {
        $user = $this->repository->find($user->getKey());

        return $user->groups->pluck('id')->toArray();
    }

    public function isSuperAdmin($user)
    {
        return $this->repository->super($user->getKey());
    }

    public function successLogin($user)
    {
        $this->repository->logLoginTime($user->getKey());
    }

    public function isActive($username)
    {
        return $this->repository->active($username);
    }

    public function isDeactive($username)
    {
        return !$this->isActive($username);
    }

    public function getUsersByRole($role)
    {
        return $this->roles->users($role);
    }

    public function getDrawingUsers($user)
    {
        if ($this->isSuperAdmin($user)) {
            return $this->getUsersByRole('teacher');
        } else {
            return $this->repository->findBy($user->getKey());
        }
    }

    public function drawGroupAndSeq($user)
    {
        $user = $this->get($user);

        DB::transaction(function () use ($user) {
            foreach ($user->groups as $group) {
                if (!$group->pivot->is_drawed) {
                    if (empty($group->pivot->seq)) {
                        $userCounts = $this->groups->countUsers(false)->keyBy('id');

                        $groups = [];
                        foreach ($group->children as $child) {
                            if ($userCounts[$child->id]->users_count < $child->number) {
                                $groups[] = [
                                    'group_id' => $child->id,
                                    'number' => $child->number,
                                ];
                            }
                        }

                        $key = array_rand($groups, 1);
                        $drawedGroup = $groups[$key];
                        $total = range(1, $drawedGroup['number']);
                        $seqs = $this->groups->getSeqs($drawedGroup['group_id']);
                        $surplus = array_diff($total, $seqs);
                        $number = array_rand($surplus, 1);
                        $drawedSeq = $surplus[$number];

                        $user->groups()->detach($group->id);
                        $user->groups()->attach([
                            $drawedGroup['group_id'] => [
                                'seq' => $drawedSeq,
                                'is_drawed' => true,
                            ]
                        ]);
                    } else {
                        $group->users()->updateExistingPivot($user->id, [
                            'is_drawed' => true,
                        ]);
                    }
                }
            }
        });
    }
}

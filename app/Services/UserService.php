<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\InternalException;
use Illuminate\Database\QueryException;
use App\Repositories\PermissionRepository;
use App\Exceptions\InvalidRequestException;

class UserService extends Service
{
    protected $permissons;

    public function __construct(UserRepository $users, PermissionRepository $permssions)
    {
        $this->repository = $users;
        $this->permissions = $permssions;
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

    public function hasPermission($user, $permission)
    {
        $user = $this->repository->find($user->getKey());
        $permission = $this->permissions->have($permission);

        return $this->repository->authenticate($user, $permission);
    }

    public function assignRole($user, $roles)
    {
        $user = $this->repository->find($user->getKey());

        $this->repository->grant($user, $roles);
    }

    public function getGrantedRoles($user)
    {
        $user = $this->repository->find($user->getKey());

        return $user->roles->pluck('id')->toArray();
    }
}

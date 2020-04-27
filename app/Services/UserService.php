<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\InvalidRequestException;

class UserService extends Service
{
    public function __construct(UserRepository $users)
    {
        $this->repository = $users;
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

    public function hasPermission($user, $module, $action)
    {
    }
}

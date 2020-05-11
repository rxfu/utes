<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Str;
use App\Services\UserService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModelPolicy
{
    use HandlesAuthorization;

    protected $service;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->service = $userService;
    }

    public function getModule()
    {
        return Str::snake(Str::substr(class_basename(get_class($this)), 0, -6));
    }

    public function getAction($action)
    {
        return $this->getModule() . '-' . $action;
    }

    public function before(User $user, $ability)
    {
        if ($user->is_super) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $this->service->hasPermission($user, $this->getAction('index'));
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return mixed
     */
    public function view(User $user, Model $model)
    {
        return $this->service->hasGroup($user, $model->group_id) && $this->service->hasPermission($user, $this->getAction('show'));
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $this->service->hasPermission($user, $this->getAction('create'));
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return mixed
     */
    public function update(User $user, Model $model)
    {
        return $this->service->hasGroup($user, $model->group_id) && $this->service->hasPermission($user, $this->getAction('edit'));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return mixed
     */
    public function delete(User $user, Model $model)
    {
        return $this->service->hasGroup($user, $model->group_id) && $this->service->hasPermission($user, $this->getAction('delete'));
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return mixed
     */
    public function restore(User $user, Model $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return mixed
     */
    public function forceDelete(User $user, Model $model)
    {
        //
    }
}

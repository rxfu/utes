<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, Authorizable, PresentableTrait;

    protected $presenter = 'App\Presenters\UserPresenter';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'name', 'email', 'phone', 'is_enable', 'last_login_at', 'uid', 'department_id', 'gender_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'is_enable' => 'boolean',
        'is_super' => 'boolean',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    public function groups()
    {
        return $this->belongsToMany('App\Models\Group')
            ->withPivot('seq', 'is_drawed')
            ->withTimestamps();
    }

    public function application()
    {
        return $this->hasOne('App\Models\Application');
    }

    public function teachers()
    {
        return $this->belongsToMany('\App\Models\User', 'scorepeers', 'judge_id', 'user_id')->withTimestamps();
    }

    public function judges()
    {
        return $this->belongsToMany('App\Models\User', 'scorepeers', 'user_id', 'judge_id')->withTimestamps();
    }

    public function gender()
    {
        return $this->belongsTo('App\Models\Gender');
    }

    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }
}

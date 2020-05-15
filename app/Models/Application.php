<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'gender_id', 'department_id', 'title_id', 'applied_title_id', 'is_applied_peer', 'course', 'time', 'classroom', 'class', 'remark', 'file',
    ];

    public function User()
    {
        return $this->hasOne('App\Models\User');
    }
}

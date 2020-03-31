<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid', 'name',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_enable' => 'boolean',
    ];

    public $timestamps = false;

    public function items()
    {
        return $this->hasMany('App\Models\Menuitem');
    }

    public function scopeIsActive($query, $uid)
    {
        return $query->whereUid($uid)->whereIsEnable(true);
    }

    public function scopeActiveItems()
    {
        return $this->hasMany('App\Models\Menuitem')->whereIsEnable(true);
    }
}

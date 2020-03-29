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

    public function menuitems()
    {
        return $this->hasMany('App\Models\Menuitem');
    }
}

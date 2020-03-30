<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menuitem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid', 'name', 'path', 'icon', 'menuitem_id', 'menu_id'
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

    public function menu()
    {
        return $this->belongsTo('App\Models\Menu');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Menuitem', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Models\Menuitem', 'parent_id');
    }
}

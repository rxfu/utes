<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Menuitem extends Model
{
    use PresentableTrait;

    protected $presenter = 'App\Presenters\MenuitemPresenter';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid', 'name', 'route', 'icon', 'parent_id', 'menu_id', 'description', 'order', 'is_enable',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_enable' => 'boolean',
        'is_system' => 'boolean',
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

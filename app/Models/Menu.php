<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Menu extends Model
{
    use PresentableTrait;

    protected $presenter = 'App\Presenters\MenuPresenter';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug', 'name', 'description', 'is_enable',
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

    public function items()
    {
        return $this->hasMany('App\Models\Menuitem');
    }

    public function activeItems()
    {
        return $this->hasMany('App\Models\Menuitem')
            ->with('parent', 'children')
            ->whereIsEnable(true)
            ->orderBy('order');
    }

    public function scopeIsActive($query, $slug)
    {
        return $query->whereSlug($slug)->whereIsEnable(true);
    }
}

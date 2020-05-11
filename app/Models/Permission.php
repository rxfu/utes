<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Permission extends Model
{
    use PresentableTrait;

    protected $presenter = 'App\Presenters\PermissionPresenter';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug', 'name', 'model', 'action', 'parent_id', 'description',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Permission', 'parent_id');
    }
}

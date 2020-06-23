<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug', 'name', 'parent_id', 'description', 'number',
    ];

    public function users()
    {
        return $this->belongsToMany('App\Models\User')
            ->withPivot('seq', 'is_drawed')
            ->withTimestamps();
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Group', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Models\Group', 'parent_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Application extends Model
{
    use PresentableTrait;

    protected $presenter = 'App\Presenters\ApplicationPresenter';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'year', 'user_id', 'gender_id', 'department_id', 'title_id', 'applied_title_id', 'is_applied_peer', 'course', 'time', 'classroom', 'class', 'remark', 'file',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function gender()
    {
        return $this->belongsTo('App\Models\Gender');
    }

    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }

    public function title()
    {
        return $this->belongsTo('App\Models\Title');
    }

    public function appliedTitle()
    {
        return $this->belongsTo('App\Models\Title', 'applied_title_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Scorepeer extends Model
{
    use PresentableTrait;

    protected $presenter = 'App\Presenters\ScorepeerPresenter';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'year', 'user_id', 'judge_id', 'score', 'is_confirmed', 'course', 'time', 'classroom', 'class', 'file', 'remark',
    ];

    public function judge()
    {
        return $this->belongsTo('App\Models\User', 'judge_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}

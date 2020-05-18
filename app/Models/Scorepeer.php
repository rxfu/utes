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
}

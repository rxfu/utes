<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scorepeer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'year', 'user_id', 'judge_id', 'number', 'score', 'is_confirmed', 'course', 'time', 'classroom', 'class', 'file', 'remark', 
    ];
}

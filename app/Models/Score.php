<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'year', 'user_id', 'student1', 'plan1', 'plan2', 'peer1', 'peer2', 'peer3', 'expert1', 'expert2', 'expert3', 'expert4', 'expert5', 'creator_id', 'remark',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function creator()
    {
        return $this->belongsTo('App\Models\User', 'creator_id', 'id');
    }
}

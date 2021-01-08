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
        'year', 'user_id', 'degree_id', 'title_id', 'applied_title_id', 'is_applied_expert', 'course', 'reason', 'is_audit', 'audit_reason', 'has_course', 'file', 'subject_id', 'remark',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function title()
    {
        return $this->belongsTo('App\Models\Title');
    }

    public function appliedTitle()
    {
        return $this->belongsTo('App\Models\Title', 'applied_title_id');
    }

    public function subject()
    {
        return $this->belongsTo('App\Models\Subject');
    }

    public function degree()
    {
        return $this->belongsTo('App\Models\Degree');
    }

    public function application()
    {
        return $this->belongsTo('App\Models\Application');
    }
}

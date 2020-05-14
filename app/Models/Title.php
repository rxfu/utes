<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Title extends Model
{
    use PresentableTrait;

    protected $presenter = 'App\Presenters\TitlePresenter';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'is_allowed', 'description',
    ];
}

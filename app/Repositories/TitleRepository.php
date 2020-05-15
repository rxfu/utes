<?php

namespace App\Repositories;

use App\Models\Title;

class TitleRepository extends Repository
{
    public function __construct(Title $title)
    {
        $this->model = $title;
    }

    public function allowed()
    {
        return $this->model->whereIsAllowed(true)->get();
    }
}

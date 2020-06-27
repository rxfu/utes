<?php

namespace App\Services;

use App\Repositories\ScoreRepository;
use App\Repositories\SettingRepository;

class ScoreService extends Service
{
    protected $settings;

    public function __construct(ScoreRepository $scores, SettingRepository $settings)
    {
        $this->repository = $scores;
        $this->settings = $settings;
    }

    public function getRank($type = null)
    {
        $year = $this->settings->item('year')->value;

        if (is_null($type)) {
            $scores = $this->repository->findBy([
                'year' => $year,
            ]);
        } else {
            switch ($type) {
            }
        }
    }
}

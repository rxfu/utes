<?php

namespace App\Services;

use App\Repositories\ScoreRepository;
use App\Repositories\SettingRepository;
use PhpParser\Node\Stmt\Foreach_;

class ScoreService extends Service
{
    protected $settings;

    private $_numStudent;

    private $_numPlan;

    private $_numPeer;

    private $_numExpert;

    public function __construct(ScoreRepository $scores, SettingRepository $settings)
    {
        $this->repository = $scores;
        $this->settings = $settings;

        $this->_numStudent = 1;
        $this->_numPlan = 2;
        $this->_numPeer = 3;
        $this->_numExpert = 5;
    }

    public function getRank($type = null)
    {
        $year = $this->settings->item('year')->value;

        if (is_null($type)) {
            $results = $this->repository->findBy([
                'year' => $year,
            ], ['user', 'user.application.department']);
        } else {
            switch ($type) {
            }
        }

        $scores = [];
        foreach ($results as $result) {
            $parts = [
                'student' => 0,
                'plan' => 0,
                'peer' => 0,
                'expert' => 0,
            ];

            array_walk($parts, function (&$v, $k, $result) {
                $type = ucfirst($k);
                $score = $v;

                for ($i = 1; $i <= $this->{'_num' . $type}; ++$i) {
                    $score += $result->{$k . $i};
                }

                $v = $score / $this->{'_num' . $type};
            }, $result);

            $total = $parts['student'] * 0.3 + $parts['plan'] * 0.1 + $parts['peer'] * 0.3 + $parts['expert'] * 0.3;

            $scores[] = [
                'id' => $result->id,
                'name' => $result->user->name,
                'department' => $result->user->application->department->name,
                'student' => round($parts['student'], 2),
                'plan' => round($parts['plan'], 2),
                'peer' => round($parts['peer'], 2),
                'expert' => round($parts['expert'], 2),
                'total' => round($total, 2),
            ];
        }

        usort($scores, function ($a, $b) {
            return $a['total'] > $b['total'] ? -1 : 1;
        });

        return $scores;
    }
}

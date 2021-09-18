<?php

namespace App\Services;

use App\Repositories\GradeRepository;
use App\Repositories\ScoreRepository;
use App\Repositories\SettingRepository;

class ScoreService extends Service
{
    protected $settings;

    protected $grades;

    private $_numStudent;

    private $_numPlan;

    private $_numPeer;

    private $_numExpert;

    public function __construct(ScoreRepository $scores, SettingRepository $settings, GradeRepository $grades)
    {
        $this->repository = $scores;
        $this->settings = $settings;
        $this->grades = $grades;

        $this->_numStudent = 1;
        $this->_numPlan = 3;
        $this->_numPeer = 3;
        $this->_numExpert = 5;
    }

    public function getRank($year = null, $type = null)
    {
        if (is_null($year)) {
            $year = $this->settings->item('year')->value;
        }

        if (is_null($type)) {
            $results = $this->repository->findBy([
                'year' => $year,
            ], ['user', 'user.department']);
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
            $grade = $this->grades->grade($total)->name;

            $scores[] = [
                'id' => $result->id,
                'name' => $result->user->name,
                'department' => optional($result->user->department)->name,
                'applied_title' => optional($result->user->application->appliedTitle)->name,
                'student' => round($parts['student'], 2),
                'plan' => round($parts['plan'], 2),
                'peer' => round($parts['peer'], 2),
                'expert' => round($parts['expert'], 2),
                'total' => round($total, 2),
                'grade' => $grade,
            ];
        }

        usort($scores, function ($a, $b) {
            $first = mb_convert_encoding($a['department'], 'gbk', 'utf-8');
            $second = mb_convert_encoding($b['department'], 'gbk', 'utf-8');

            return $first < $second ? -1 : 1;
        });

        return $scores;
    }

    public function getYears()
    {
        return $this->repository->years();
    }
}

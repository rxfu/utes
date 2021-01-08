<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ScoreExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::join('applications', 'users.id', 'applications.user_id')
            ->join('departments', 'users.department_id', 'departments.id')
            ->leftJoin('scores', 'users.id', 'scores.user_id')
            ->select('users.id', 'users.name AS name', 'departments.name AS department', 'student1', 'plan1', 'plan2', 'peer1', 'peer2', 'peer3', 'expert1', 'expert2', 'expert3', 'expert4', 'expert5', 'scores.remark')
            ->whereIsSuper(false)
            ->orderBy('department')
            ->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            '姓名',
            '学院',
            '学生评价成绩1',
            '教案评价成绩1',
            '教案评价成绩2',
            '同行评价成绩1',
            '同行评价成绩2',
            '同行评价成绩3',
            '专家评价成绩1',
            '专家评价成绩2',
            '专家评价成绩3',
            '专家评价成绩4',
            '专家评价成绩5',
            '备注',
        ];
    }
}

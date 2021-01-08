<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection, WithHeadings
{
    protected $year;

    public function __construct($year)
    {
        $this->year = $year;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $year = $this->year;

        return User::join('applications', function ($join) use ($year) {
            $join->on('users.id', '=', 'applications.user_id')
                ->where('applications.year', '=', $year);
        })
            ->leftJoin('genders', 'users.gender_id', 'genders.id')
            ->leftJoin('departments', 'users.department_id', 'departments.id')
            ->leftJoin('degrees', 'applications.degree_id', 'degrees.id')
            ->leftJoin('titles', 'applications.title_id', 'titles.id')
            ->leftJoin('titles As applied_titles', 'applications.applied_title_id', 'applied_titles.id')
            ->leftJoin('subjects', 'applications.subject_id', 'subjects.id')
            ->whereIsSuper(false)
            ->select('users.id', 'applications.year', 'users.uid', 'users.name AS user', 'genders.name AS gender', 'users.phone', 'users.email', 'departments.name AS department', 'degrees.name AS degree', 'titles.name AS title', 'applied_titles.name AS appliedTitle', 'applications.has_course', 'applications.is_applied_expert', 'applications.reason', 'applications.course', 'subjects.name AS subject', 'applications.remark')
            ->orderBy('departments.id')
            ->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            '年度',
            '工号',
            '姓名',
            '性别',
            '联系电话',
            '邮箱',
            '学院',
            '学历/学位',
            '现有职称',
            '拟申报职称',
            '本学期是否有课',
            '是否申请专家评价',
            '不申请专家评价理由',
            '主讲本科课程名称',
            '主讲本科课程所属学科',
            '备注',
        ];
    }
}

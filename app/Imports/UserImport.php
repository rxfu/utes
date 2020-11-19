<?php

namespace App\Imports;

use App\Models\Role;
use App\Models\User;
use App\Models\Title;
use App\Models\Degree;
use App\Models\Gender;
use App\Models\Subject;
use App\Models\Department;
use Maatwebsite\Excel\Row;
use App\Services\SettingService;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImport implements OnEachRow, WithHeadingRow
{
    protected $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    /**
     * @param \Maatwebsite\Excel\Row $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row = $row->toArray();

        if (isset($row['gender'])) {
            $gender = Gender::firstOrCreate([
                'name' => $row['gender'],
            ]);
        }

        if (isset($row['title'])) {
            $title = Title::firstOrCreate([
                'name' => $row['title'],
            ]);
        }

        if (isset($row['applied_title'])) {
            $appliedTitle = Title::firstOrCreate([
                'name' => $row['applied_title'],
            ]);
        }

        $department = Department::firstOrCreate([
            'name' => $row['department'],
        ]);

        if (isset($row['subject'])) {
            $subject = Subject::firstOrCreate([
                'name' => $row['subject'],
            ]);
        }

        if (isset($row['degree'])) {
            $degree = Degree::firstOrCreate([
                'name' => $row['degree'],
            ]);
        }

        $user = User::firstOrCreate([
            'username' => str_replace(' ', '', $row['phone']),
            'password' => '123456',
            'name' => str_replace(' ', '', $row['name']),
            'phone' => $row['phone'],
            'email' => $row['email'] ?? null,
            'gender_id' => isset($gender) ? $gender->id : null,
            'department_id' => $department->id,
        ]);

        $row['role'] = isset($row['role']) ? $row['role'] : 'teacher';
        $role = Role::firstOrCreate([
            'slug' => $row['role'],
        ]);
        $user->roles()->attach($role->id);

        if (isset($row['group'])) {
            $user->groups()->attach($row['group']);
        }

        if ($row['role'] == 'teacher') {

            // 导入测评教师申请材料
            $user->application()->create([
                'year' => $this->settingService->getSetting('year'),
                'user_id' => $user->id,
                'title_id' => isset($title) ? $title->id : null,
                'applied_title_id' => isset($appliedTitle) ? $appliedTitle->id : null,
                'is_applied_expert' => $row['is_applied_expert'] ?? true,
                'course' => isset($row['course']) ? preg_replace('#\s+#', '<br>', $row['course']) : null,
                'reason' => isset($row['reason']) ? $row['reason'] : 0,
                'has_course' => isset($row['has_course']) ? $row['has_course'] : 1,
                'subject_id' => isset($subject) ? $subject->id : null,
                'degree_id' => isset($degree) ? $degree->id : null,
                'remark' => $row['remark'] ?? null,
            ]);
        }
    }
}

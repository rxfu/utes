<?php

namespace App\Imports;

use App\Models\Role;
use App\Models\User;
use App\Models\Title;
use App\Models\Gender;
use App\Models\Department;
use Maatwebsite\Excel\Row;
use App\Services\SettingService;
use App\Services\ScorepeerService;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImport implements OnEachRow, WithHeadingRow
{
    protected $settingService;

    protected $peerService;

    public function __construct(SettingService $settingService, ScorepeerService $peerService)
    {
        $this->settingService = $settingService;
        $this->peerService = $peerService;
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
        $user = User::firstOrCreate([
            'username' => str_replace(' ', '', $row['phone']),
            'password' => '123456',
            'name' => str_replace(' ', '', $row['name']),
            'phone' => $row['phone'],
            'email' => $row['email'] ?? null,
        ]);
        $role = Role::firstOrCreate([
            'slug' => $row['role'],
        ]);
        $user->roles()->attach($role->id);

        if ($row['role'] == 'teacher') {

            // 导入测评教师申请材料
            $user->application()->create([
                'year' => $this->settingService->getSetting('year'),
                'user_id' => $user->id,
                'gender_id' => isset($gender) ? $gender->id : null,
                'department_id' => $department->id,
                'title_id' => isset($title) ? $title->id : null,
                'applied_title_id' => isset($appliedTitle) ? $appliedTitle->id : null,
                'is_applied_peer' => $row['is_applied_peer'],
                'course' => preg_replace('#\s+#', '<br>', $row['course']),
                'time' => preg_replace('#\s+#', '<br>', $row['time']),
                'classroom' => preg_replace('#\s+#', '<br>', $row['classroom']),
                'class' => preg_replace('#\s+#', '<br>', $row['class']),
                'remark' => $row['remark'] ?? null,
            ]);

            // 导入测评教师分配评委
            $judges = User::whereIn('name', [$row['judge1'], $row['judge2'], $row['judge3']]);
            $this->peerService->assignJudge($user, $judges->pluck('id')->toArray());
        }
    }
}

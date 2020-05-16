<?php

namespace App\Imports;

use App\Models\Role;
use App\Models\User;
use App\Models\Title;
use App\Models\Gender;
use App\Models\Department;
use App\Services\SettingService;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TeacherImport implements OnEachRow, WithHeadingRow
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

        $department = Department::firstOrCreate([
            'name' => $row['department'],
        ]);
        $gender = Gender::firstOrCreate([
            'name' => $row['gender'],
        ]);
        $title = Title::firstOrCreate([
            'name' => $row['title'],
        ]);
        $appliedTitle = Title::firstOrCreate([
            'name' => $row['applied_title'],
        ]);
        $user = User::firstOrCreate([
            'username' => str_replace(' ', '', $row['phone']),
            'password' => '123456',
            'name' => str_replace(' ', '', $row['name']),
            'phone' => $row['phone'],
            'email' => $row['email'],
        ]);
        $role = Role::firstOrCreate([
            'slug' => $row['role'],
        ]);
        $user->roles()->attach($role->id);

        $user->application()->create([
            'year' => $this->settingService->getSetting('year'),
            'user_id' => $user->id,
            'gender_id' => $gender->id,
            'department_id' => $department->id,
            'title_id' => $title->id,
            'applied_title_id' => $appliedTitle->id,
            'is_applied_peer' => $row['is_applied_peer'],
            'course' => preg_replace('#\s+#', '<br>', $row['course']),
            'time' => preg_replace('#\s+#', '<br>', $row['time']),
            'classroom' => preg_replace('#\s+#', '<br>', $row['classroom']),
            'class' => preg_replace('#\s+#', '<br>', $row['class']),
            'remark' => $row['remark'] ?? null,
        ]);
    }
}

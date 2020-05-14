<?php

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
            'name'       => '文学院',
        ]);
        Department::create([
            'name'       => '历史文化与旅游学院',
        ]);
        Department::create([
            'name'       => '马克思主义学院',
        ]);
        Department::create([
            'name'       => '法学院',
        ]);
        Department::create([
            'name'       => '政治与公共管理学院',
        ]);
        Department::create([
            'name'       => '经济管理学院',
        ]);
        Department::create([
            'name'       => '教育学部',
        ]);
        Department::create([
            'name'       => '外国语学院',
        ]);
        Department::create([
            'name'       => '美术学院',
        ]);
        Department::create([
            'name'       => '音乐学院',
        ]);
        Department::create([
            'name'       => '数学与统计学院',
        ]);
        Department::create([
            'name'       => '物理科学与技术学院',
        ]);
        Department::create([
            'name'       => '化学与药学学院',
        ]);
        Department::create([
            'name'       => '生命科学学院',
        ]);
        Department::create([
            'name'       => '环境与资源学院',
        ]);
        Department::create([
            'name'       => '计算机科学与信息工程学院',
        ]);
        Department::create([
            'name'       => '体育学院',
        ]);
        Department::create([
            'name'       => '电子工程学院',
        ]);
        Department::create([
            'name'       => '职业技术师范学院',
        ]);
        Department::create([
            'name'       => '健康管理学院',
        ]);
        Department::create([
            'name'       => '设计学院',
        ]);
    }
}

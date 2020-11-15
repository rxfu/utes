<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'name' => 'maintenance',
            'value' => '0',
            'description' => '系统维护开关，1-开启维护，关闭系统，0-关闭维护，开启系统',
        ]);

        Setting::create([
            'name' => 'year',
            'value' => '2020',
            'description' => '年度，4位年份',
        ]);

        Setting::create([
            'name' => 'register',
            'value' => '0',
            'description' => '测评教师注册开关，0-关闭注册，1-开启注册',
        ]);
    }
}

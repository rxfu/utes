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
    }
}

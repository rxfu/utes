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
            'name' => 'switch',
            'value' => 'true',
            'description' => '系统开关，true-开启，false-关闭',
        ]);
    }
}

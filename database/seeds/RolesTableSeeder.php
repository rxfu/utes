<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'uid' => 'admin',
            'name' => '管理员',
        ]);

        Role::create([
            'uid' => 'user',
            'name' => '普通用户',
        ]);
    }
}

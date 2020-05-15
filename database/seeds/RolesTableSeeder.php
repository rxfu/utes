<?php

use App\Models\Permission;
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
        $role = Role::create([
            'slug' => 'admin',
            'name' => '管理员',
        ]);

        $role->permissions()->sync(Permission::all()->pluck('id')->toArray());

        Role::create([
            'slug' => 'teacher',
            'name' => '测评教师',
        ]);

        Role::create([
            'slug' => 'peer',
            'name' => '同行评委',
        ]);

        Role::create([
            'slug' => 'expert',
            'name' => '专家评委',
        ]);

        Role::create([
            'slug' => 'plan',
            'name' => '教案评委',
        ]);

        Role::create([
            'slug' => 'office',
            'name' => '评建办',
        ]);
    }
}

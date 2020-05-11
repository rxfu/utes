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
            'slug' => 'user',
            'name' => '普通用户',
        ]);
    }
}

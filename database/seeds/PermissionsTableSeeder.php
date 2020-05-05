<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'slug' => 'home',
            'name' => '首页',
            'action' => 'index',
            'model' => 'home',
        ]);

        Permission::create([
            'slug' => 'contact',
            'name' => '联系我们',
            'action' => 'contact',
            'model' => 'home',
        ]);

        $modules = [
            'user', 'menu', 'menuitem', 'log', 'role', 'permission'
        ];

        $actions = [
            'create', 'edit', 'delete', 'show', 'index',
        ];

        foreach ($modules as $module) {
            foreach ($actions as $action) {
                Permission::create([
                    'slug' => $module . '-' . $action,
                    'name' => __($action) . __($module . '.module'),
                    'action' => $action,
                    'model' => $module,
                ]);
            }
        }

        Permission::create([
            'slug' => 'password-change',
            'name' => '修改密码',
            'action' => 'change',
            'model' => 'user',
        ]);

        Permission::create([
            'slug' => 'password-reset',
            'name' => '重置密码',
            'action' => 'reset',
            'model' => 'user',
        ]);

        Permission::create([
            'slug' => 'role-grant',
            'name' => '分配角色',
            'action' => 'grant',
            'model' => 'user',
        ]);

        Permission::create([
            'slug' => 'permission-grant',
            'name' => '分配权限',
            'action' => 'grant',
            'model' => 'role',
        ]);
    }
}

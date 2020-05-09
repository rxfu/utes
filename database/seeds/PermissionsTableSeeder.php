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
            'action' => 'home',
            'model' => 'navigation',
        ]);

        Permission::create([
            'slug' => 'contact',
            'name' => '联系我们',
            'action' => 'contact',
            'model' => 'navigation',
        ]);

        Permission::create([
            'slug' => 'log-index',
            'name' => '列出日志',
            'action' => 'index',
            'model' => 'log',
        ]);

        Permission::create([
            'slug' => 'log-show',
            'name' => '查看日志',
            'action' => 'show',
            'model' => 'log',
        ]);

        $modules = [
            'setting', 'menu', 'menuitem', 'group', 'role', 'permission', 'user',
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
            'action' => 'changePassword',
            'model' => 'user',
        ]);

        Permission::create([
            'slug' => 'password-reset',
            'name' => '重置密码',
            'action' => 'resetPassword',
            'model' => 'user',
        ]);

        Permission::create([
            'slug' => 'group-assign',
            'name' => '分配组',
            'action' => 'assignGroup',
            'model' => 'user',
        ]);

        Permission::create([
            'slug' => 'role-assign',
            'name' => '分配角色',
            'action' => 'assignRole',
            'model' => 'user',
        ]);

        Permission::create([
            'slug' => 'permission-assign',
            'name' => '分配权限',
            'action' => 'assignPermission',
            'model' => 'role',
        ]);
    }
}

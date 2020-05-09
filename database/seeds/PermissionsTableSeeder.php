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
        /* 
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
            'user', 'menu', 'menuitem', 'log', 'role', 'permission', 'group', 'setting',
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

        Permission::create([
            'slug' => 'group-assign',
            'name' => '分配组',
            'action' => 'assignGroup',
            'model' => 'user',
        ]);
        */

        foreach (config('setting.permissions') as $model => $actions) {
            if (is_array($actions)) {
                foreach ($actions as $action) {
                    var_dump(__($action));
                    Permission::create([
                        'slug' => $model . '-' . $action,
                        'name' => __($action) . __($model . '.module'),
                        'action' => $action,
                        'model' => $model,
                    ]);
                }
            } else {
                Permission::create([
                    'slug' => $actions,
                    'name' => __($actions),
                    'action' => $actions,
                    'model' => 'home',
                ]);
            }
        }
    }
}

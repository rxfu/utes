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
        $modules = [
            'user', 'menu', 'menuitem', 'log',
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
                    'module' => $module,
                ]);
            }
        }

        Permission::create([
            'slug' => 'user-change',
            'name' => '修改密码',
            'action' => 'change',
            'module' => 'user',
        ]);

        Permission::create([
            'slug' => 'user-reset',
            'name' => '重置密码',
            'action' => 'reset',
            'module' => 'user',
        ]);
    }
}

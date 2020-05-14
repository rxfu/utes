<?php

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::create([
            'slug' => 'main',
            'name' => '主菜单',
            'is_system' => true,
        ]);

        Menu::create([
            'slug' => 'navigation',
            'name' => '导航菜单',
            'is_system' => true,
        ]);

        $menu = Menu::find(2);
        $menu->items()->createMany([
            [
                'slug' => 'home',
                'name' => '使用说明',
                'route' => 'home',
                'order' => 1,
            ],
            [
                'slug' => 'contact',
                'name' => '联系我们',
                'route' => 'contact',
                'order' => 2,
            ],
        ]);

        $menu = Menu::find(1);
        $menu->items()->createMany([
            [
                'slug' => 'dashboard',
                'name' => '仪表盘',
                'route' => 'home',
                'icon' => 'tachometer-alt',
                'order' => -999,
            ],
            [
                'slug' => 'menu-manage',
                'name' => '菜单管理',
                'icon' => 'sitemap',
                'is_system' => true,
                'order' => 4,
            ],
            [
                'slug' => 'menu',
                'name' => '菜单管理',
                'route' => 'menus.index',
                'parent_id' => 4,
                'is_system' => true,
                'order' => 5,
            ],
            [
                'slug' => 'menuitem',
                'name' => '菜单项管理',
                'route' => 'menuitems.index',
                'parent_id' => 4,
                'is_system' => true,
                'order' => 6,
            ],
            [
                'slug' => 'user-manage',
                'name' => '用户管理',
                'icon' => 'users',
                'is_system' => true,
                'order' => 7,
            ],
            [
                'slug' => 'user',
                'name' => '用户管理',
                'route' => 'users.index',
                'parent_id' => 7,
                'is_system' => true,
                'order' => 8,
            ],
            [
                'slug' => 'role',
                'name' => '角色管理',
                'route' => 'roles.index',
                'parent_id' => 7,
                'is_system' => true,
                'order' => 9,
            ],
            [
                'slug' => 'permission',
                'name' => '权限管理',
                'route' => 'permissions.index',
                'parent_id' => 7,
                'is_system' => true,
                'order' => 10,
            ],
            [
                'slug' => 'group',
                'name' => '组管理',
                'route' => 'groups.index',
                'parent_id' => 7,
                'is_system' => true,
                'order' => 11,
            ],
            [
                'slug' => 'system-manage',
                'name' => '系统管理',
                'icon' => 'cogs',
                'is_system' => true,
                'order' => 12,
            ],
            [
                'slug' => 'password-change',
                'name' => '修改密码',
                'route' => 'passwords.change',
                'parent_id' => 12,
                'is_system' => true,
                'order' => 13,
            ],
            [
                'slug' => 'setting',
                'name' => '系统设置',
                'route' => 'settings.index',
                'parent_id' => 12,
                'is_system' => true,
                'order' => 14,
            ],
            [
                'slug' => 'log',
                'name' => '日志查询',
                'route' => 'logs.index',
                'parent_id' => 12,
                'is_system' => true,
                'order' => 15,
            ],
            [
                'slug' => 'dictionary',
                'name' => '数据字典',
                'icon' => 'database',
                'is_system' => true,
                'order' => 1,
            ],
            [
                'slug' => 'gender',
                'name' => '性别管理',
                'route' => 'genders.index',
                'parent_id' => 16,
                'is_system' => true,
                'order' => 1,
            ],
            [
                'slug' => 'department',
                'name' => '学院管理',
                'route' => 'departments.index',
                'parent_id' => 16,
                'is_system' => true,
                'order' => 2,
            ],
            [
                'slug' => 'title',
                'name' => '职称管理',
                'route' => 'titles.index',
                'parent_id' => 16,
                'is_system' => true,
                'order' => 3,
            ],
            [
                'slug' => 'grade',
                'name' => '评价等级管理',
                'route' => 'grades.index',
                'parent_id' => 16,
                'is_system' => true,
                'order' => 4,
            ],
        ]);
    }
}

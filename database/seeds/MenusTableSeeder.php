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
            'uid' => 'main',
            'name' => '主菜单',
            'is_system' => true,
        ]);

        Menu::create([
            'uid' => 'navigation',
            'name' => '导航菜单',
            'is_system' => true,
        ]);

        $menu = Menu::find(2);
        $menu->items()->createMany([
            [
                'uid' => 'item1',
                'name' => '使用说明',
                'route' => 'home',
            ],
            [
                'uid' => 'item2',
                'name' => '联系我们',
                'route' => 'contact',
            ],
        ]);

        $menu = Menu::find(1);
        $menu->items()->createMany([
            [
                'uid' => 'item3',
                'name' => '仪表盘',
                'route' => 'home',
                'icon' => 'tachometer-alt',
            ],
            [
                'uid' => 'item4',
                'name' => '菜单管理',
                'icon' => 'tachometer-alt',
                'is_system' => true,
            ],
            [
                'uid' => 'item5',
                'name' => '菜单管理',
                'route' => 'menus.index',
                'icon' => 'tachometer-alt',
                'parent_id' => 4,
                'is_system' => true,
            ],
            [
                'uid' => 'item6',
                'name' => '菜单项管理',
                'route' => 'menuitems.index',
                'icon' => 'tachometer-alt',
                'parent_id' => 4,
                'is_system' => true,
            ],
            [
                'uid' => 'item7',
                'name' => '用户管理',
                'icon' => 'users',
                'is_system' => true,
            ],
            [
                'uid' => 'item8',
                'name' => '用户管理',
                'route' => 'users.index',
                'parent_id' => 7,
                'is_system' => true,
            ],
            [
                'uid' => 'item9',
                'name' => '角色管理',
                'route' => 'roles.index',
                'parent_id' => 7,
                'is_system' => true,
            ],
            [
                'uid' => 'item10',
                'name' => '权限管理',
                'route' => 'permissions.index',
                'parent_id' => 7,
                'is_system' => true,
            ],
            [
                'uid' => 'item11',
                'name' => '系统管理',
                'icon' => 'tachometer-alt',
                'is_system' => true,
            ],
            [
                'uid' => 'item12',
                'name' => '修改密码',
                'route' => 'passwords.create',
                'parent_id' => 11,
                'is_system' => true,
            ],
            [
                'uid' => 'item13',
                'name' => '日志查询',
                'route' => 'logs.index',
                'parent_id' => 11,
                'is_system' => true,
            ],
            [
                'uid' => 'item14',
                'name' => '系统设置',
                'route' => 'settings.index',
                'parent_id' => 11,
                'is_system' => true,
            ],
        ]);
    }
}

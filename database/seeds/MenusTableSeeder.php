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
            'uid' => 'navigation',
            'name' => '导航菜单',
        ]);

        Menu::create([
            'uid' => 'main',
            'name' => '主菜单',
        ]);

        $item = Menu::find(1);
        $item->menuitems()->createMany([
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

        $item = Menu::find(2);
        $item->menuitems()->createMany([
            [
                'uid' => 'item3',
                'name' => '仪表盘',
                'route' => 'home',
                'icon' => 'tachometer-alt',
            ],
            [
                'uid' => 'item4',
                'name' => '系统管理',
                'icon' => 'tachometer-alt',
            ],
            [
                'uid' => 'item5',
                'name' => '修改密码',
                'icon' => 'shield-alt',
                'parent_id' => 4,
            ],
        ]);
    }
}

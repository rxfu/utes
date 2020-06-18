<?php

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::create([
            'slug' => 'liberal',
            'name' => '文科组',
        ]);
        Group::create([
            'slug' => 'science',
            'name' => '理科组',
        ]);

        Group::create([
            'slug' => 'liberal1',
            'name' => '文科一组',
            'parent_id' => 1,
            'number' => 26,
        ]);
        Group::create([
            'slug' => 'liberal2',
            'name' => '文科二组',
            'parent_id' => 1,
            'number' => 26,
        ]);
        Group::create([
            'slug' => 'liberal3',
            'name' => '文科三组',
            'parent_id' => 1,
            'number' => 26,
        ]);
        Group::create([
            'slug' => 'liberal4',
            'name' => '文科四组',
            'parent_id' => 1,
            'number' => 26,
        ]);

        Group::create([
            'slug' => 'science1',
            'name' => '理科一组',
            'parent_id' => 2,
            'number' => 27,
        ]);
        Group::create([
            'slug' => 'science2',
            'name' => '理科二组',
            'parent_id' => 2,
            'number' => 27,
        ]);
    }
}

<?php

use App\Models\Title;
use Illuminate\Database\Seeder;

class TitlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Title::create([
            'name' => '讲师',
        ]);
        Title::create([
            'name' => '副教授',
            'is_allowed' => true,
        ]);
        Title::create([
            'name' => '教授',
            'is_allowed' => true,
        ]);
        Title::create([
            'name' => '助理研究员',
        ]);
        Title::create([
            'name' => '副研究员',
        ]);
        Title::create([
            'name' => '研究员',
        ]);
        Title::create([
            'name' => '馆员',
        ]);
        Title::create([
            'name' => '副研究馆员',
        ]);
        Title::create([
            'name' => '研究馆员',
        ]);
        Title::create([
            'name' => '主治医师',
        ]);
        Title::create([
            'name' => '副主任医师',
        ]);
        Title::create([
            'name' => '主任医师',
        ]);
        Title::create([
            'name' => '未定级',
        ]);
        Title::create([
            'name' => '副高',
        ]);
    }
}

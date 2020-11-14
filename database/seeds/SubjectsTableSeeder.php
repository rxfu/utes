<?php

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::create([
            'name' => '哲学',
        ]);
        Subject::create([
            'name' => '经济学',
        ]);
        Subject::create([
            'name' => '法学',
        ]);
        Subject::create([
            'name' => '教育学',
        ]);
        Subject::create([
            'name' => '文学',
        ]);
        Subject::create([
            'name' => '历史学',
        ]);
        Subject::create([
            'name' => '理学',
        ]);
        Subject::create([
            'name' => '工学',
        ]);
        Subject::create([
            'name' => '农学',
        ]);
        Subject::create([
            'name' => '医学',
        ]);
        Subject::create([
            'name' => '军事',
        ]);
        Subject::create([
            'name' => '管理学',
        ]);
        Subject::create([
            'name' => '艺术学',
        ]);
    }
}

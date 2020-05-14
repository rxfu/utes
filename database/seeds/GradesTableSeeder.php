<?php

use App\Models\Grade;
use Illuminate\Database\Seeder;

class GradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Grade::create([
            'slug' => 'a',
            'name' => '优秀',
            'max_score' => 100,
            'min_score' => 90,
        ]);
        Grade::create([
            'slug' => 'b',
            'name' => '良好',
            'max_score' => 89.99,
            'min_score' => 76,
        ]);
        Grade::create([
            'slug' => 'c',
            'name' => '合格',
            'max_score' => 75.99,
            'min_score' => 60,
        ]);
        Grade::create([
            'slug' => 'd',
            'name' => '不合格',
            'max_score' => 59.99,
            'min_score' => 0,
        ]);
    }
}

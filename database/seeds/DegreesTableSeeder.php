<?php

use App\Models\Degree;
use Illuminate\Database\Seeder;

class DegreesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Degree::create([
            'name' => '无',
        ]);
        Degree::create([
            'name' => '学士',
        ]);
        Degree::create([
            'name' => '硕士',
        ]);
        Degree::create([
            'name' => '博士',
        ]);
    }
}

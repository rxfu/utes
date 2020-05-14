<?php

use App\Models\Gender;
use Illuminate\Database\Seeder;

class GendersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gender::create([
            'name' => '男',
        ]);
        Gender::create([
            'name' => '女',
        ]);
    }
}

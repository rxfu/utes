<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'username' => 'admin',
            'password' => '123456',
            'name' => '系统管理员',
            'is_super' => true,
        ]);
    }
}

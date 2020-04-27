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
            'name' => 'Administrator',
            'is_super' => true,
        ]);

        $role = Role::whereSlug('admin')->firstOrFail();
        $user->roles()->attach($role->id);
    }
}

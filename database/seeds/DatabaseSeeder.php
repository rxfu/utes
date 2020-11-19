<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(GendersTableSeeder::class);
        $this->call(TitlesTableSeeder::class);
        $this->call(DepartmentsTableSeeder::class);
        $this->call(GradesTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
        $this->call(DegreesTableSeeder::class);
    }
}

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
        $this->call([
          UsersTableSeeder::class,
          OrganisationsTableSeeder::class,
          OrganisationUserTableSeeder::class,
          GroupsTableSeeder::class,
          LabelsTableSeeder::class,
          ProjectsTableSeeder::class,
          TasksTableSeeder::class,
          LabelTaskTableSeeder::class,
          TaskUserTableSeeder::class
        ]);
    }
}

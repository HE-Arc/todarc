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
          ProjectsTableSeeder::class,
          GroupsTableSeeder::class,
          LabelsTableSeeder::class,
          TasksTableSeeder::class,
          LabelTaskTableSeeder::class,
          TaskUserTableSeeder::class
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('projects')->insert([[
          'name' => 'Todarc',
          'owner_id' => 1,
          'owner_type' => 'App\Organisation'
      ],[
          'name' => 'Private todo board',
          'owner_id' => 1,
          'owner_type' => 'App\User'
      ]]);
    }
}

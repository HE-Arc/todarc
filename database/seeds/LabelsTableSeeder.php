<?php

use Illuminate\Database\Seeder;

class LabelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('labels')->insert([
          'name' => 'Dev',
          'color' => '#FF0000',
          'project_id' => 1
      ],[
          'name' => 'Bug',
          'color' => '#00FF00',
          'project_id' => 1
      ],[
          'name' => 'High-priority',
          'color' => '#0000FF',
          'project_id' => 1
      ],[
          'name' => 'Need Help',
          'color' => '#c20000',
          'project_id' => 2
      ],[
          'name' => 'Easy',
          'color' => '#008ec2',
          'project_id' => 2
      ]);
    }
}

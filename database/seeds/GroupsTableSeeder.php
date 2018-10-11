<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('groups')->insert([
          'name' => 'Main',
          'group_id' => null,
          'project_id' => 1
      ],[
          'name' => 'Second level',
          'group_id' => 1,
          'project_id' => 1
      ],[
          'name' => 'Third level',
          'group_id' => 2,
          'project_id' => 1
      ],[
          'name' => 'Another second level',
          'group_id' => 1,
          'project_id' => 1
      ],[
          'name' => 'Main for private repo',
          'group_id' => null,
          'project_id' => 2
      ]);
    }
}

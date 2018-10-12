<?php

use Illuminate\Database\Seeder;

class LabelTaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('label_task')->insert([[
          'task_id' => 1,
          'label_id' => 1
      ],[
          'task_id' => 1,
          'label_id' => 2
      ],[
          'task_id' => 1,
          'label_id' => 3
      ],[
          'task_id' => 3,
          'label_id' => 3
      ],[
          'task_id' => 2,
          'label_id' => 2
      ]]);
    }
}

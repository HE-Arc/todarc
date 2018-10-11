<?php

use Illuminate\Database\Seeder;

class TaskUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('task_user')->insert([
        'user_id' => 1,
        'task_id' => 1
      ],[
        'user_id' => 1,
        'task_id' => 2
      ],[
        'user_id' => 1,
        'task_id' => 3
      ]);
    }
}

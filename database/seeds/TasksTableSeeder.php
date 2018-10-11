<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            'name' => 'Create Seeder',
            'from_date' => Carbon::parse('2018-10-06'),
            'until_date' => Carbon::parse('2018-10-18'),
            'order' => 1,
            'group_id' => 1
        ],[
            'name' => 'Organisation DashBoard',
            'from_date' => Carbon::parse('2018-10-06'),
            'until_date' => null,
            'order' => 1,
            'group_id' => 2
        ],[
            'name' => 'Cut my hair',
            'from_date' => Carbon::parse('2018-10-06'),
            'until_date' => null,
            'order' => 1,
            'group_id' => 5
        ],[
            'name' => 'DashBoard interface',
            'from_date' => Carbon::parse('2018-10-06'),
            'until_date' => Carbon::parse('2018-10-18'),
            'order' => 3,
            'group_id' => 3
        ]);
    }
}

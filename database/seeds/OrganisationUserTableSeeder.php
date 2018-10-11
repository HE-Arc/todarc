<?php

use Illuminate\Database\Seeder;

class OrganisationUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('organisation_user')->insert([
        'user_id' => 1,
        'organisation_id' => 1
      ]);
    }
}

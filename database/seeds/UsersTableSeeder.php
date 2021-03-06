<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
        'name' => 'Nobody',
        'email' => 'iamadmin@todarc.com',
        'password' => bcrypt('strongpassword')
      ]);

      DB::table('users')->insert([
        'name' => 'Alfred',
        'email' => 'alfred@todarc.com',
        'password' => bcrypt('strongpassword')
      ]);

      DB::table('users')->insert([
        'name' => 'Germaine',
        'email' => 'germaine@todarc.com',
        'password' => bcrypt('strongpassword')
      ]);
    }
}

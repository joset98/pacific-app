<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //Admin
      DB::table("users")->insert([
        'name' => 'admin',
        'last_name' => 'LTE',
        'username' => 'adminLTE',
        'email' => 'admin@gmail.com',
        'role' => 'admin',
        'rut' => '9274973',
        'password' => Hash::make('secret'), // password
      ]);
    }
}

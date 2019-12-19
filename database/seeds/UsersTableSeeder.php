<?php

use Illuminate\Database\Seeder;
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
        DB::table('users')->insert([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@gmail.com.br',
            'image' => 'https://i.imgur.com/RrNjD6b.jpg',
            'password' => bcrypt('Admin123@'),
            'role_id' => 1
        ]);
    }
}

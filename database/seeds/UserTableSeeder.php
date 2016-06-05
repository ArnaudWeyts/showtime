<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Users table seeder
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'ArnaudWeyts',
            'firstname' => 'Arnaud',
            'lastname' => 'Weyts',
            'email' => 'arnaud.weyts@gmail.com',
            'location' => 'Oudenaarde, Belgium',
            'password' => bcrypt(env('ADMINPASS')),
            'type' => 'admin',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}

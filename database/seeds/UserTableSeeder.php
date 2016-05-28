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
            'username' => 'KevinP',
            'firstname' => 'Kevin',
            'lastname' => 'Picalausa',
            'email' => 'kevin.picalausa@odisee.be',
            'location' => 'Gent, Belgium',
            'karma' => -1000,
            'password' => bcrypt('Azerty123'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'username' => 'Joriske1',
            'firstname' => 'Joris',
            'lastname' => 'Maervoet',
            'email' => 'joris.maervoet@odisee.be',
            'location' => 'Rupelmonde, Belgium',
            'karma' => 826,
            'type' => 'verified',
            'password' => bcrypt('Azerty123'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'username' => 'Janneke',
            'firstname' => 'Jan',
            'lastname' => 'Janssens',
            'email' => 'jan.janssens@odisee.be',
            'location' => 'Boom, Belgium',
            'password' => bcrypt('Azerty123'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'username' => 'ArnaudWeyts',
            'firstname' => 'Arnaud',
            'lastname' => 'Weyts',
            'email' => 'arnaud.weyts@gmail.com',
            'location' => 'Oudenaarde, Belgium',
            'password' => bcrypt('admin'),
            'type' => 'admin',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'username' => 'EliasMeire',
            'firstname' => 'Elias',
            'lastname' => 'Meire',
            'email' => 'elias.meire@gmail.com',
            'location' => 'Gent, Belgium',
            'password' => bcrypt('mod'),
            'type' => 'mod',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}

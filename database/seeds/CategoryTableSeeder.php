<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {
        DB::table('categories')->insert([
        	'name' => 'Action'
        ]);
        DB::table('categories')->insert([
        	'name' => 'Adventure'
        ]);
        DB::table('categories')->insert([
        	'name' => 'Animation'
        ]);
        DB::table('categories')->insert([
            'name' => 'Comedy'
        ]);
        DB::table('categories')->insert([
            'name' => 'Crime'
        ]);
        DB::table('categories')->insert([
        	'name' => 'Documentary'
        ]);
        DB::table('categories')->insert([
        	'name' => 'Drama'
        ]);
        DB::table('categories')->insert([
        	'name' => 'Family'
        ]);
        DB::table('categories')->insert([
        	'name' => 'Fantasy'
        ]);
        DB::table('categories')->insert([
        	'name' => 'Horor'
        ]);
        DB::table('categories')->insert([
        	'name' => 'Sci-Fi'
        ]);
        DB::table('categories')->insert([
            'name' => 'Thriller'
        ]);
    }
}

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
        	'name' => 'Fantasy',
        	'show_id' => 1
        ]);
        DB::table('categories')->insert([
        	'name' => 'Drama',
        	'show_id' => 1
        ]);
        DB::table('categories')->insert([
        	'name' => 'Action',
        	'show_id' => 2
        ]);
        DB::table('categories')->insert([
        	'name' => 'Drama',
        	'show_id' => 2
        ]);
        DB::table('categories')->insert([
        	'name' => 'Sci-Fi',
        	'show_id' => 2
        ]);
        DB::table('categories')->insert([
            'name' => 'Comedy',
            'show_id' => 3
        ]);
        DB::table('categories')->insert([
            'name' => 'Drama',
            'show_id' => 3
        ]);
        DB::table('categories')->insert([
            'name' => 'Drama',
            'show_id' => 4
        ]);
        DB::table('categories')->insert([
            'name' => 'Drama',
            'show_id' => 5
        ]);
        DB::table('categories')->insert([
            'name' => 'Crime',
            'show_id' => 5
        ]);
        DB::table('categories')->insert([
            'name' => 'Thriller',
            'show_id' => 5
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class ShowCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('show_categories')->insert([
            'category_id' => 9,
            'show_id' => 1
        ]);
        DB::table('show_categories')->insert([
            'category_id' => 7,
            'show_id' => 1
        ]);
        DB::table('show_categories')->insert([
            'category_id' => 1,
            'show_id' => 2
        ]);
        DB::table('show_categories')->insert([
            'category_id' => 7,
            'show_id' => 2
        ]);
        DB::table('show_categories')->insert([
            'category_id' => 11,
            'show_id' => 2
        ]);
        DB::table('show_categories')->insert([
            'category_id' => 4,
            'show_id' => 3
        ]);
        DB::table('show_categories')->insert([
            'category_id' => 7,
            'show_id' => 3
        ]);
        DB::table('show_categories')->insert([
            'category_id' => 7,
            'show_id' => 4
        ]);
        DB::table('show_categories')->insert([
            'category_id' => 7,
            'show_id' => 5
        ]);
        DB::table('show_categories')->insert([
            'category_id' => 5,
            'show_id' => 5
        ]);
        DB::table('show_categories')->insert([
            'category_id' => 12,
            'show_id' => 5
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class ReviewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reviews')->insert([
        	'show_id' => 1,
        	'user_id' => 1,
        	'title' => 'Amazing show',
        	'shortcontent' => 'I really love this show. Good characters, good scenes, good CGI, good storyline. This show literally has it all!',
        	'rating' => 10,
        	'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('reviews')->insert([
        	'show_id' => 2,
        	'user_id' => 1,
        	'title' => 'Amazing show',
        	'shortcontent' => 'I really love this show. Good characters, good scenes, good CGI, good storyline. This show literally has it all!',
        	'rating' => 10,
        	'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('reviews')->insert([
        	'show_id' => 2,
        	'user_id' => 3,
        	'title' => 'Amazing show',
        	'shortcontent' => 'I really love this show. Good characters, good scenes, good CGI, good storyline. This show literally has it all!',
        	'rating' => 9,
            'upvotes' => 90,
        	'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('reviews')->insert([
        	'show_id' => 2,
        	'user_id' => 2,
        	'title' => 'I hate this show so much',
        	'shortcontent' => 'I love it when they kill all of my favourite characters! So down to earth. I always get depressed afterwards and it\'s fun! FEMINISM 4 LIFE',
        	'rating' => 1,
        	'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class ShowTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shows')->insert([
        	'title' => 'Game of Thrones',
        	'description' => 'While a civil war brews between several noble families in Westeros, the children of the former rulers of the land attempt to rise up to power. Meanwhile a forgotten race, bent on destruction, plans to return after thousands of years in the North.',
        	'creatorname' => 'David Benioff, D.B. Weiss',
            'trailerurl' => 'https://www.youtube.com/embed/522l0YE9hRQ',
        	'numreviews' => 1,
        	'releaseyear' => 2011,
        	'endyear' => null,
        	'rating' => 9,
        	'numepisodes' => 62,
            'numseasons' => 6,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('shows')->insert([
            'title' => 'The 100',
            'description' => 'Set 97 years after a nuclear war has destroyed civilization, when a spaceship housing humanity\'s lone survivors sends 100 juvenile delinquents back to Earth in hopes of possibly re-populating the planet.',
            'creatorname' => 'Jason Rothenberg',
            'numreviews' => 3,
            'trailerurl' => 'https://www.youtube.com/embed/aDrsItJ_HU4',
            'releaseyear' => 2014,
            'endyear' => null,
            'rating' => 8,
            'numepisodes' => 46,
            'numseasons' => 3,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('shows')->insert([
            'title' => 'Master of None',
            'description' => 'The personal and professional life of Dev, a 30-year-old actor in New York.',
            'creatorname' => 'Aziz Ansari, Alan Yang',
            'numreviews' => 0,
            'trailerurl' => 'https://www.youtube.com/embed/6bFvb3WKISk',
            'releaseyear' => 2015,
            'endyear' => null,
            'rating' => 8,
            'numepisodes' => 11,
            'numseasons' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('shows')->insert([
            'title' => 'House of Cards',
            'description' => 'A Congressman works with his equally conniving wife to exact revenge on the people who betrayed him.',
            'creatorname' => 'Beau Willimon',
            'numreviews' => 0,
            'trailerurl' => 'https://www.youtube.com/embed/EvGL42rywPM',
            'releaseyear' => 2013,
            'endyear' => null,
            'rating' => 9,
            'numepisodes' => 53,
            'numseasons' => 4,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('shows')->insert([
            'title' => 'Mr Robot',
            'description' => 'Follows a young computer programmer who suffers from social anxiety disorder and forms connections through hacking. He\'s recruited by a mysterious anarchist, who calls himself Mr. Robot.',
            'creatorname' => 'Sam Esmail',
            'numreviews' => 0,
            'trailerurl' => 'https://youtube.com/embed/U94litUpZuc',
            'releaseyear' => 2015,
            'endyear' => null,
            'rating' => 9,
            'numepisodes' => 10,
            'numseasons' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}

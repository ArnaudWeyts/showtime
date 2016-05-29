<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shows', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->string('creatorname');
            $table->integer('numreviews')->default(0);
            $table->string('trailerurl')->nullable();
            $table->tinyinteger('numseasons');
            $table->smallinteger('releaseyear');
            $table->smallinteger('endyear')->nullable();
            $table->tinyinteger('rating')->nullable();
            $table->smallinteger('numepisodes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shows');
    }
}

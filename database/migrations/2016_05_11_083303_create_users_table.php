<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
	   		$table->increments('id');
	   		$table->enum('type', array('regular', 'verified', 'mod', 'admin'))->default('regular');
			$table->string('username')->unique();
			$table->string('firstname')->nullable();
			$table->string('lastname')->nullable();
			$table->string('location')->nullable();
			$table->string('email')->unique();
			$table->tinyinteger('age')->nullable();
			$table->integer('karma')->default(0);
			$table->text('bio')->nullable();
			$table->string('password');
			$table->rememberToken();
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
		Schema::drop('users');
	}
}

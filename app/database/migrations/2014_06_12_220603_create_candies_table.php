<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('candies', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 256);
			$table->string('url', 256);
			// User
			$table->integer('user_id')->length(10)->unsigned();
			$table->foreign('user_id')
			->references('id')->on('users')
			->onDelete('no action');
			// Times
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('candies');
	}

}

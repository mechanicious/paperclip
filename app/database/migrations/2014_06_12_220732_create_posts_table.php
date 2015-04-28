<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table)
		{
			$table->increments('id');

			// Title
			$table->string('title', 256);
			$table->index('title');

			// Post
			$table->mediumText('post')->nullable();
			
			// Candy (built-in image slider)
			$table->integer('candy_id')->length(10)->unsigned()->nullable();

			// User
			$table->integer('user_id')->length(10)->unsigned();
			$table->foreign('user_id')
			->references('id')->on('users')
			->onDelete('no action');
	
			// Timestamps
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
		Schema::drop('posts');
	}

}

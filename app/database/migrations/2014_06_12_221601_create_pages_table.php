<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pages', function(Blueprint $table)
		{
			$table->increments('id');
			// Name
			$table->string('name', 256);
			$table->index('name');
			
			// Password
			$table->string('password', 256)->nullable();
			
			// Content
			$table->mediumText('content')->nullable();
			
			// Language
			$table->integer('language_id')->length(10)->unsigned();
			$table->index('language_id');
			$table->foreign('language_id')
			->references('id')->on('languages')
			->onDelete('cascade');

			// User
			$table->integer('user_id')->length(10)->unsigned();
			$table->foreign('user_id')
			->references('id')->on('users')
			->onDelete('no action');
			
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
		Schema::drop('pages');
	}

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function(Blueprint $table)
		{
			$table->increments('id');
			// Category
			$table->string('category', 256);
			// Description
			$table->string('description', 256)->nullable();
			$table->index('category');
			// User
			$table->integer('user_id')->length(10)->unsigned();
			$table->foreign('user_id')
			->references('id')->on('users')
			->onDelete('no action');
			// Language
			$table->integer('language_id')->length(10)->unsigned();
			$table->foreign('language_id')
			->references('id')->on('languages')
			->onDelete('cascade');
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
		Schema::drop('categories');
	}

}

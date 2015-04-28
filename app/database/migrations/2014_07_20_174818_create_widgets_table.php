<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWidgetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('widgets', function(Blueprint $table)
		{
			$table->increments('id');
			// Name
			$table->string('title');
			$table->index('title');
			
			// Strict name
			$table->string('strictName')->unqiue();
			
			// User settings
			$table->text('userSettings')->nullable();

			// A short description
			$table->string('description')->nullable();
			
			// Body template name
			$table->string('bodyTemplateName');

			// Version
			$table->string('previousVersion', 6)->nullable();
			$table->string('currentVersion', 6)->nullable();

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
		Schema::drop('widgets');
	}

}

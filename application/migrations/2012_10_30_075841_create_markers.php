<?php

class Create_Markers {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('markers', function($table)
		{
			$table->increments('id');
			$table->string('name', 60);
			$table->string('adress', 80);
			$table->integer('lat');
			$table->integer('long');
			$table->string('type', 30);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('markers');
	}

}
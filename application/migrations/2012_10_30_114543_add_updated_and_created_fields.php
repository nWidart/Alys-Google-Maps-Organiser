<?php

class Add_Updated_And_Created_Fields {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('markers', function($table){
			$table->timestamps();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		$table->drop_column('created_at');
		$table->drop_column('updated_at');
	}

}
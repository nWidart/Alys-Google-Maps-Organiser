<?php

class Add_Url_To_Img_In_Markers {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('markers', function($table){
			$table->string('img_url', 200);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		$table->drop_column('img_url');
	}

}
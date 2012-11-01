<?php

class Adding_5_Fields_To_Markers {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('markers', function($table)
		{
			$table->string('rem1', 200);
			$table->string('rem2', 200);
			$table->string('rem3', 200);
			$table->string('rem4', 200);
			$table->string('rem5', 200);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		$table->drop_column('rem1');
		$table->drop_column('rem2');
		$table->drop_column('rem3');
		$table->drop_column('rem4');
		$table->drop_column('rem5');
	}

}
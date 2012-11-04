<?php

class New_User {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('users')->insert(array(
		    'username'  => 'Lemmens',
		    'password'  => Hash::make('lemmens'),
		    'group' => 2,
		    'client_id' => 2
		));
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
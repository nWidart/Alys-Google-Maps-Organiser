<?php

class User_Controller extends Base_Controller
{
	public $restful = true;

	public function get_profile()
	{
		$client = User::find( Auth::user()->id );
			
		return View::make('client.profile-client')
			->with('client', $client);
	}
}
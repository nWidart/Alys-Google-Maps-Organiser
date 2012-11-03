<?php

class Company_Controller extends Base_Controller
{
	public $restful = true;

	public function __construct()
	{
		Session::flush();
	}

	public function get_buhlmann()
	{
		Session::put('client_name_s', 'buhlmann');
		Session::put('client_id_s', '1');
		return View::make('extern.index-client');
	}

	public function get_lemmens()
	{
		Session::put('client_name_s', 'lemmens');
		Session::put('client_id_s', '2');
		return View::make('extern.index-client');
	}
	public function get_testing()
	{
		Session::put('client_name_s', 'testing');
		Session::put('client_id_s', '3');
		return View::make('extern.index-client');
	}
}
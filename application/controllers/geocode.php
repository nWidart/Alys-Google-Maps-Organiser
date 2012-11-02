<?php

class Geocode_Controller extends Base_Controller
{
	public $restful = true;

	public function get_index()
	{

		return View::make('geocode');
	}

	public function post_index()
	{
		$address = Input::get('address');
		$address = urlencode($address);
		$loc = geocoder::getLocation($address);

		return View::make('geocode')
			->with('lng', $loc['lng'])
			->with('lat', $loc['lat']);
	}

}
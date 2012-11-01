<?php 
class Marker extends Eloquent
{
	public static $table = 'markers';

	public function client()
	{
		return $this->belongs_to('Client', 'client_id');
	}
}
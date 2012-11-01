<?php

class Client extends Eloquent
{
	public static $table = 'clients';

	public function markers()
	{
		return $this->has_many('marker');
	}

}
<?php

class Site_domain extends Eloquent 
{
	
	public static $timestamps = true;

	public function __construct()
	{
		Log::debug("Loading Site_domain");
	}

	public function site()
	{
		return $this->belongs_to('Site');
	}

}
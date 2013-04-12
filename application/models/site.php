<?php

class Site extends Eloquent 
{

	public static $timestamps = true;

	public function users()
	{
		return $this->has_many('User');
	}

	public function domains()
	{
		return $this->has_many('Site_domain');
	}

	public function options()
	{
		return $this->has_many('Site_option');
	}

}
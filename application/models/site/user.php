<?php

class Site_user extends Eloquent 
{
	public static $timestamps = true;

	public function user()
	{
		return $this->has_one('User');
	}

	public function site()
	{
		return $this->has_one('Site');
	}
}
<?php

class User_link extends Eloquent 
{
	public static $timestamps = false;

	public function user()
	{
		return $this->belongs_to('User');
	}
}
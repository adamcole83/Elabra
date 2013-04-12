<?php

class Group extends Eloquent 
{
	public static $timestamps = true;

	public function permissions()
	{
		return $this->has_many_and_belongs_to('Permission');
	}

	public function users()
	{
		return $this->has_many('User');
	}
}
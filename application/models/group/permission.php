<?php

class Group_permission extends Eloquent 
{
	public static $timestamps = true;

	public function group()
	{
		return $this->has_many('Group');
	}

	public function permission()
	{
		return $this->has_many('Permission');
	}
}
<?php

class Permission extends Eloquent 
{
	public static $timestamps = true;

	public function group()
	{
		return $this->has_many_and_belongs_to('Group');
	}
}
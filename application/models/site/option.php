<?php

class Option extends Eloquent 
{

	public function site()
	{
		return $this->belongs_to('Site');
	}

}
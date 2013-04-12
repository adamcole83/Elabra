<?php

class Attempts extends Eloquent 
{
	public static $timestamps = false;

	protected static $limit = array();

	protected $login_id = null;

	protected $ip_address = null;

	protected $attempts = null;

	public function __construct($login_id = null, $ip_address = null)
	{
		static::$limit = array(
			'enabled'  => Config::get('application.auth.limit.enabled'),
			'attempts' => Config::get('application.auth.limit.attempts'),
			'time'     => Config::get('application.auth.limit.time')
		);
		$this->login_id = $login_id;
		$this->ip_address = $ip_address;

		if ($this->login_id)
		{
			$this->where('login_id', '=', $this->login);
		}
		
		if ($this->ip_address)
		{
			$this->where('ip_address' '=', $this->ip_address);
		}

		$result = $this->first();
	}
}
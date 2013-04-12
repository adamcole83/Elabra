<?php

class User extends Eloquent 
{
	
	public static $timestamps = true;

	public function login($login, $password, $remember_me = false)
	{
		Auth::logout();


		$login_column = Config::get('application.auth.login_column');



		if ($remember_me)
		{
			Cookie::put('remember_me', )
		}

		return Auth::attempt(array(
			$login_column => $login,
			'password'    => $password
		));
	}

	public function has_access($resource = null)
	{
		if (in_array(Config::get('application.auth.superuser'), $this->permissions))
		{
			return true;
		}

		if ( ! in_array($resource, $this->permissions))
		{
			return false;
		}

		return true;
	}

	public function attempt($login_id, $ip_address)
	{
		$table = "user_attempts";
		$found = DB::first("SELECT * FROM {$table} WHERE login_id = ?", array($login_id));

		if ( ! $found)
		{
			$bindings = array($login_id, 1, $ip_address);
			DB::query("INSERT INTO {$table} VALUES (?, ?, ?)", $bindings);
			$found = DB::first("SELECT * FROM {$table} WHERE id = ?", array($login_id));
		}
		else
		{
			$bindings = array(($found->attempts + 1), $login_id);
			DB::query("UPDATE {$table} SET attempts = ? WHERE login_id = ?", $bindings);
		}


	}

	public function clear_attempts($login_id)
	{

	}

	public function suspend_user($login_id)
	{

	}

	public function unsuspend_user($login_id)
	{

	}

	/*
	 * Relationships
	 *
	 */
	public function links()
	{
		return $this->has_many('User_link');
	}

	public function profile()
	{
		return $this->has_one('User_profile');
	}

	public function sites()
	{
		return $this->has_many_and_belongs_to('Site');
	}

	public function groups()
	{
		return $this->has_many_and_belongs_to('Group');
	}

	/*
	 * Setters & Getters
	 */
	public function get_group()
	{
		return Group::find($this->get_attribute('group_id'));
	}

	public function get_permissions()
	{
		$permissions = array();
		foreach($this->group->permissions as $permission)
		{
			$permissions[] = $permission->name;
		}
		return $permissions;
	}
	
}
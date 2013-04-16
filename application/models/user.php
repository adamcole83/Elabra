<?php

class User extends Eloquent 
{
	
	public static $timestamps = true;

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
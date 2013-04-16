<?php 

class LDAPauth extends Laravel\Auth\Drivers\Driver {

	protected $connection;

	protected $ldap_type;

	protected $level;

	public $user;

	public function __construct()
	{
		// determine if we need to use ldap or not
		$this->level = (int) Config::get('auth.ldap.level');

		// check if the ldap extension is installed
		if ($this->level >= 1 and ! function_exists('ldap_connect'))
		{
			throw new \Exception('Authentication requires the php-ldap extension to be installed.');
		}

		// load ldap_type at start if we're using ldap
		if ($this->level >= 1)
		{
			$this->ldap_type = Config::get('auth.ldap.ldap_type');
		}

		parent::__construct();
	}

	public function __destruct()
	{
		if ( ! is_null($this->connection))
		{
			ldap_unbind($this->connection);
		}
	}

	public function retrieve($token)
	{
		// if we're using the database as fallback, retrieve that data
		if ($this->level <= 1)
		{
			if (filter_var($token, FILTER_VALIDATE_INT) !== false)
			{
				return $this->user = $this->model()->find($token);
			}
			return false;
		}

		if (is_null($this->connection))
		{
			// create a connection using a control account
			try
			{
				$this->ldap_connect(Config::get('auth.ldap.control_user'), Config::get('auth.ldap.control_password'));
			}
			catch (Exception $e)
			{
				throw new Exception('LDAP Control account error: '.ldap_error($this->connection));
				return;
			}
		}

		try
		{
			if ($user = $this->get_user_by_dn($token))
			{
				return $user;
			}
			echo 'No user found for '.$token;
		}
		catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function attempt($arguments = array())
	{
		// this driver uses a basic username and password authentication scheme
		// so if the credentials match what is in the database, we will just
		// log the user into the application and remember them if asked.
		$username = $arguments['username'];
		$password = $arguments['password'];

		if (empty($username) or empty($password))
		{
			return false;
		}

		$group = Config::get('auth.ldap.group');
		$token = false;

		switch ($this->level)
		{
			// database authentication
			case 0:
				$user = $this->authenticate($username, $password);
				$token = $user->id;
				break;

			// ldap authentication with database fallback
			case 1:
				;
				if ($user = $this->model()->where('username', '=', $username)->first())
				{
					try
					{
						$this->ldap_authenticate($username, $password);
					}
					catch (Exception $e)
					{
						if ( ! $this->authenticate($username, $password))
						{
							return false;
						}
					}
					$token = $user->id;
				}
				break;

			// ldap authentication
			case 2:
				$user = $this->ldap_authenticate($username, $password, $group);
				$token = $user->dn;
				break;
		}

		if ($token)
		{
			return $this->login($token, array_get($arguments, 'remember'));
		}

		return false;
	}

	protected function ldap_authenticate($username, $password, $group = null)
	{
		// attempt to connect to ldap with credentials
		if ( ! $this->ldap_connect($username, $password))
		{
			throw new Exception('Could not connect to LDAP: '.ldap_error($this->connection));
		}

		$group_obj = $this->get_account($group, Config::get('auth.ldap.base_dn'));
		$user_obj = $this->get_account($username, Config::get('auth.ldap.base_dn'));

		if ($group && ! $this->check_group($user_obj['dn'], $group_obj['dn']))
		{
			throw new Exception('User is not part of the '.$group.' group.');
		}

		return $this->clean_user($user_obj);
	}

	protected function authenticate($username, $password)
	{
		$auth_username = Config::get('auth.username');

		$user = $this->model()->where($auth_username, '=', $username)->first();

		if ( ! is_null($user))
		{
			if ($this->level == 0 and ! Hash::check($password, $user->password))
			{
				return false;
			}
			return $user;
		}

		return false;
	}

	protected function ldap_connect($user, $password)
	{
		$config = Config::get('auth.ldap');

		// guess base dn from domain
		if ( ! isset($config['base_dn']))
		{
			$i = strrpos($config['domain'], '.');
			$config['base_dn'] = sprintf('dc=%s,dc=%s',
				substr($config['domain'], 0, $i),
				substr($config['domain'], $i+1));
			Config::set('auth.ldap.base_dn', $config['base_dn']);
		}

		// connect to the controller
		if ( ! $this->connection = ldap_connect("ldap://{$config['host']}:{$config['port']}"))
		{
			throw new Exception("Could not connect to LDAP host {$config['host']}: ".ldap_error($this->connection));
		}

		// required settings for Windows AD
		ldap_set_option($this->connection, LDAP_OPT_PROTOCOL_VERSION, 3);
		ldap_set_option($this->connection, LDAP_OPT_REFERRALS, 0);

		if ($this->ldap_type == 'openldap')
		{
			$user_dn = '';

			if ( ! isset($config['user_dn']))
			{
				$user_dn = $config['base_dn'];
			}
			else
			{
				$user_dn = $config['user_dn'];
			}

			$user_search = $config['user_search'];

			$rdn = "{$user_search}={$user},{$user_dn}";

			// try to authenticate
			if (@ldap_bind($this->connection, $rdn, $password))
			{
				return true;
			}
		}
		if ($this->ldap_type == 'ad')
		{
			// try to authenticate
			if (@ldap_bind($this->connection, "{$user}@{$config['domain']}", $password))
			{
				return true;
			}
		}

		return false;
	}

	protected function clean_user($user)
	{
		if ( ! isset($user['cn'][0]))
		{
			throw new Exception('Not a valid user object');
		}

		$user_search = Config::get('auth.ldap.user_search');

		if ($this->ldap_type == 'openldap')
		{
			return (object) array(
				'dn' => $user['dn'],
				'name' => $user['cn'][0],
				'username' => strtolower($user[$user_search][0]),
				'firstname' => $user['givenname'][0],
				'lastname' => $user['sn'][0],
				'uid' => $user['uid'][0],
				'member' => isset($user['member']) ? $user['member'] : array('count' => 0),
			);
		}

		if ($this->ldap_type == 'ad')
		{
			return (object) array(
				'dn' => $user['dn'],
				'name' => $user['cn'][0],
				'username' => strtolower($user[$user_search][0]),
				'firstname' => $user['givenname'][0],
				'lastname' => $user['sn'][0],
				'objectguid' => $user['objectguid'][0],
				'memberof' => isset($user['memberof']) ? $user['memberof'] : array('count' => 0),
			);
		}
	}

	/*
	 * Searches the LDAP tree for the specified account or group
	 */
	protected function get_account($account, $basedn)
	{
		if (is_null($this->connection))
		{
			throw new Exception('No LDAP connection bound');
		}

		$attr = array();

		$user_search = Config::get('auth.ldap.user_search');

		if ($this->ldap_type == 'openldap')
		{
			$attr = array('dn', 'givenname', 'sn', 'cn', 'member', 'uid', $user_search);
		}

		if ($this->ldap_type == 'ad')
		{
			$attr = array('dn', 'givenname', 'sn', 'cn', 'memberof', 'objectguid', $user_search);
		}

		$result = ldap_search($this->connection, $basedn, "({$user_search}={$account})", $attr);
		if ($result == false)
		{
			return null;
		}

		$entries = ldap_get_entries($this->connection, $result);
		if ($entries['count'] > 0)
		{
			return $entries[0];
		}
	}

	/*
	 * Checks group membership of the user, search
	 * in the specified group and its children (recursively)
	 */
	public function check_group($userdn, $groupdn)
	{
		if ( ! $user = $this->get_user_by_dn($userdn))
		{
			throw new Exception('Invalid userDN');
		}

		for ($i = 0; $i < $user->memberof['count']; $i++)
		{
			if ($groupdn == $user->memberof[$i])
			{
				return true;
			}
		}

		return false;
	}

	public function get_user_by_dn($userdn)
	{
		if (is_null($this->connection))
		{
			throw new Exception('No LDAP connection bound');
		}

		$result = ldap_read($this->connection, $userdn, '(objectclass=*)');

		if ($result === false)
		{
			return null;
		}

		$entries = ldap_get_entries($this->connection, $result);
		if ( ! $entries['count'])
		{
			return null;
		}

		return $this->clean_user($entries[0]);
	}

	protected function model()
	{
		$model = Config::get('auth.model');

		return new $model;
	}

}

























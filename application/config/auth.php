<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Default Authentication Driver
	|--------------------------------------------------------------------------
	|
	| Laravel uses a flexible driver-based system to handle authentication.
	| You are free to register your own drivers using the Auth::extend
	| method. Of course, a few great drivers are provided out of
	| box to handle basic authentication simply and easily.
	|
	| Drivers: 'fluent', 'eloquent'.
	|
	*/

	'driver' => 'LDAPauth',

	/*
	|--------------------------------------------------------------------------
	| Authentication Username
	|--------------------------------------------------------------------------
	|
	| Here you may specify the database column that should be considered the
	| "username" for your users. Typically, this will either be "username"
	| or "email". Of course, you're free to change the value to anything.
	|
	*/

	'username' => 'email',

	/*
	|--------------------------------------------------------------------------
	| Authentication Password
	|--------------------------------------------------------------------------
	|
	| Here you may specify the database column that should be considered the
	| "password" for your users. Typically, this will be "password" but, 
	| again, you're free to change the value to anything you see fit.
	|
	*/

	'password' => 'password',

	/*
	|--------------------------------------------------------------------------
	| Authentication Model
	|--------------------------------------------------------------------------
	|
	| When using the "eloquent" authentication driver, you may specify the
	| model that should be considered the "User" model. This model will
	| be used to authenticate and load the users of your application.
	|
	*/

	'model' => 'User',

	/*
	|--------------------------------------------------------------------------
	| Authentication Table
	|--------------------------------------------------------------------------
	|
	| When using the "fluent" authentication driver, the database table used
	| to load users may be specified here. This table will be used in by
	| the fluent query builder to authenticate and load your users.
	|
	*/

	'table' => 'users',

	/*
	|--------------------------------------------------------------------------
	| LDAP Authentication
	|--------------------------------------------------------------------------
	|
	| Here you may specify the settings for which your Active Directory or
	| OpenLDAP server uses. By default this is disabled but you may enable
	| the use of LDAP Authentication. This will only check the username
	| and password against the LDAP server, if the user doesn't authenticate
	| it will use the database as a fallback.
	|
	*/

	'ldap' => array(

		/*
		|--------------------------------------------------------------------------
		| LDAP Authentication level
		|--------------------------------------------------------------------------
		|
		| Levels:
		|	0 - Fully rely on database authentication
		|	1 - Authenticate against LDAP but use database as fallback
		|	2 - Fully rely on LDAP authentication & user organization
		|
		*/
		'level' => 1,
		
		/*
		|--------------------------------------------------------------------------
		| LDAP Hostname
		|--------------------------------------------------------------------------
		|
		| Hostname of the domain controller
		|
		*/
		'host' => 'ldap.missouri.edu',

		/*
		|--------------------------------------------------------------------------
		| LDAP Port
		|--------------------------------------------------------------------------
		|
		| Port of the domain controller
		|
		*/
		'port' => 3268,
		
		/*
		|--------------------------------------------------------------------------
		| LDAP Domain
		|--------------------------------------------------------------------------
		|
		| The domain name, null for OpenLDAP
		|
		*/
		'domain' => 'umh.edu',
		
		/*
		|--------------------------------------------------------------------------
		| LDAP Type
		|--------------------------------------------------------------------------
		|
		| Which type of server are we connecting to (openldap or ad)?
		|
		*/
		'ldap_type' => 'ad',
		
		/*
		|--------------------------------------------------------------------------
		| Base DN
		|--------------------------------------------------------------------------
		|
		| Required for OpenLDAP, null for ad
		|
		*/
		'base_dn' => 'dc=edu',

		/*
		|--------------------------------------------------------------------------
		| User DN
		|--------------------------------------------------------------------------
		|
		| Required for OpenLDAP, null for ad
		|
		*/
		'user_dn' => null,
		
		/*
		|--------------------------------------------------------------------------
		| LDAP User Search
		|--------------------------------------------------------------------------
		|
		| Required attribute for user search
		|
		| e.g.  samaccountname for ad
		|       uid for openldap
		|
		*/
		'user_search' => 'samaccountname',
		
		/*
		|--------------------------------------------------------------------------
		| LDAP Group Validation
		|--------------------------------------------------------------------------
		|
		| Optionally require users to be in this group, null if you don't
		| require ldap group validation.
		|
		*/
		'group' => null,
		
		/*
		|--------------------------------------------------------------------------
		| LDAP Control User
		|--------------------------------------------------------------------------
		|
		| Domain credentials the app should use to validate users
		| This user doesn't need any privileges, it's just used to connect to the DC
		|
		*/
		'control_user'     => 'umhssomwebinquiries',
		'control_password' => 'Pass1234',

	),

);
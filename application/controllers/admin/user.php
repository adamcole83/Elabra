<?php

class Admin_User_Controller extends Base_Controller {    

    public function __construct()
    {
        parent::__construct();

    }

	public function action_index()
    {
        // Grab all users
        

        // Return the view
        return View::make('admin.users.index')->with('users', $users);
    }    

	public function action_show($id)
    {
        // Find the user using the user id
        

        // Return the view
        return View::make('admin.users.show')->with('user', $user);
    }    

	public function action_new()
    {
        
        return View::make('admin.users.new');
    }    

	public function action_edit($id)
    {
        

        return View::make('admin.users.edit');
    }    

	public function action_delete()
    {
        return "Delete User";
    }

    public function action_authenticate()
    {
        // Attempt to log the user in
        if (User::login(Input::get(Config::get('sentry::login_column')), Input::get('password'), Input::get('remember_me')))
        {
            // If successful, redirect to page requested
            Redirect::to(Session::get('requested_page'));
        }
        else
        {
            // If unsuccessful, redirect to login to try again
            Session::flash('Unable to login');
            Redirect::to('login');
        }
    }

    public function action_login()
    {
        return View::make('admin.users.login');
    }

    public function action_logout()
    {
        // Log the user out
        //User::logout();

        // Redirect the user to login
        Redirect::to('login');
    }

}
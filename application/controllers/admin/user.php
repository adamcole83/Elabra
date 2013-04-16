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

}
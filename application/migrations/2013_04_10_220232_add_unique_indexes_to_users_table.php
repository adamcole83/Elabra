<?php

class Add_Unique_Indexes_To_Users_Table {    

	public function up()
    {
		Schema::table('users', function($table) 
		{
			// Add unique indexes
			$table->unique('email');
			$table->unique('username');
		});

    }    

	public function down()
    {
		Schema::drop('users');

	}

}
<?php

class Create_Users_Metadata_Table {    

	public function up()
    {
		Schema::create('users_metadata', function($table) {
			$table->integer('user_id');
			$table->string('first_name');
			$table->string('last_name');
			$table->integer('default_site');
	});

    }    

	public function down()
    {
		Schema::drop('users_metadata');

    }

}
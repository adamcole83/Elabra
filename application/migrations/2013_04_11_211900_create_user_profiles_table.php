<?php

class Create_User_Profiles_Table {    

	public function up()
    {
		Schema::create('user_profiles', function($table) {
			$table->integer('user_id');
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->text('bio')->nullable();
	});

    }    

	public function down()
    {
		Schema::drop('user_profiles');

    }

}
<?php

class Create_User_Profiles_Table {    

	public function up()
    {
		Schema::create('profiles', function($table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->text('bio')->nullable();
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('profiles');

    }

}
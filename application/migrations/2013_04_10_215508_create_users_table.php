<?php

class Create_Users_Table {    

	public function up()
    {
		Schema::create('users', function($table) {
			$table->increments('id');
			$table->string('username');
			$table->string('email');
			$table->string('password');
			$table->string('password_reset_hash');
			$table->string('temp_password');
			$table->string('remember_me');
			$table->string('activation_hash');
			$table->string('ip_address');
			$table->string('status');
			$table->string('activated');
			$table->text('permissions');
			$table->timestamp('last_login');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('users');

    }

}
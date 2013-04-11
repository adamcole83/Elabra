<?php

class Create_Users_Table {    

	public function up()
    {
		Schema::create('users', function($table) {
			$table->increments('id');
			$table->string('username')->unique();
			$table->string('email')->unique();
			$table->string('password');
			$table->string('password_reset_hash')->nullable();
			$table->string('temp_password')->nullable();
			$table->string('remember_me')->nullable();
			$table->string('activation_hash')->nullable();
			$table->string('ip_address')->nullable();
			$table->string('status');
			$table->string('activated');
			$table->integer('group_id');
			$table->timestamp('last_login');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('users');

    }

}
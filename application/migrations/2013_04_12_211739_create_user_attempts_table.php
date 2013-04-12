<?php

class Create_User_Attempts_Table {    

	public function up()
    {
		Schema::create('user_attempts', function($table) {
			$table->increments('id');
			$table->string('login_id');
			$table->integer('attempts');
			$table->string('ip_address');
			$table->timestamp('last_attempt_at')->default('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
			$table->timestamp('suspended_at')->default('0000-00-00 00:00:00');
			$table->timestamp('unsuspended_at')->default('0000-00-00 00:00:00');
	});

    }    

	public function down()
    {
		Schema::drop('user_attempts');

    }

}
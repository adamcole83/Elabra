<?php

class Create_Site_User_Table {    

	public function up()
    {
		Schema::create('site_user', function($table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('site_id');
			$table->integer('default');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('site_user');

    }

}
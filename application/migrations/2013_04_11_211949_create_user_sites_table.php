<?php

class Create_User_Sites_Table {    

	public function up()
    {
		Schema::create('sites', function($table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('site_id');
			$table->integer('default');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('sites');

    }

}
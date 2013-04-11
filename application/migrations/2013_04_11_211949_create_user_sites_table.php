<?php

class Create_User_Sites_Table {    

	public function up()
    {
		Schema::create('user_sites', function($table) {
			$table->integer('user_id');
			$table->integer('site_id');
			$table->integer('default');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('user_sites');

    }

}
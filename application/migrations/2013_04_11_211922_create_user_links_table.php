<?php

class Create_User_Links_Table {    

	public function up()
    {
		Schema::create('user_links', function($table) {
			$table->integer('user_id');
			$table->string('type');
			$table->string('title');
			$table->string('link');
	});

    }    

	public function down()
    {
		Schema::drop('user_links');

    }

}
<?php

class Create_User_Links_Table {    

	public function up()
    {
		Schema::create('links', function($table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->string('type');
			$table->string('title');
			$table->string('link');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('links');

    }

}
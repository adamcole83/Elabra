<?php

class Create_Sites_Table {    

	public function up()
    {
		Schema::create('sites', function($table) {
			$table->increments('id');
			$table->string('name');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('sites');

    }

}
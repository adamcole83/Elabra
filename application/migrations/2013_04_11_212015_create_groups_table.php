<?php

class Create_Groups_Table {    

	public function up()
    {
		Schema::create('groups', function($table) {
			$table->increments('id');
			$table->string('name');
			$table->string('description')->nullable();
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('groups');

    }

}
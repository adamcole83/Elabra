<?php

class Create_Permissions_Table {    

	public function up()
    {
		Schema::create('permissions', function($table) {
			$table->increments('id');
			$table->string('name');
			$table->string('description')->nullable();
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('permissions');

    }

}
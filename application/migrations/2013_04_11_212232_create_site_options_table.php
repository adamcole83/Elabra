<?php

class Create_Site_Options_Table {    

	public function up()
    {
		Schema::create('options', function($table) {
			$table->increments('id');
			$table->integer('site_id');
			$table->string('option_name');
			$table->text('option_value');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('options');

    }

}
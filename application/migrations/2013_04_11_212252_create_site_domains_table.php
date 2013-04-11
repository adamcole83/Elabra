<?php

class Create_Site_Domains_Table {    

	public function up()
    {
		Schema::create('domains', function($table) {
			$table->increments('id');
			$table->integer('site_id');
			$table->string('domain')->unique();
			$table->integer('default');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('domains');

    }

}
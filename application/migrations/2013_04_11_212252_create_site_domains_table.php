<?php

class Create_Site_Domains_Table {    

	public function up()
    {
		Schema::create('site_domains', function($table) {
			$table->increments('id');
			$table->integer('site_id');
			$table->string('domain')->unique();
			$table->integer('default')->default(0);
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('site_domains');

    }

}
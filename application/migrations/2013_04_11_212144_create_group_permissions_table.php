<?php

class Create_Group_Permissions_Table {    

	public function up()
    {
		Schema::create('group_permissions', function($table) {
			$table->increments('id');
			$table->integer('permission_id');
			$table->integer('group_id');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('group_permissions');

    }

}
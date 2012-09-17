<?php

class Create_Clients_Table {

	public function up()
	{
		Schema::create('clients', function($table) {
			$table->increments('id');
			$table->string('name');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}

}
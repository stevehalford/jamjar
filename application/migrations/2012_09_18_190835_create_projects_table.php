<?php

class Create_Projects_Table {

	public function up()
	{
		Schema::create('projects', function($table) {
			$table->increments('id');
			$table->integer('client_id');
			$table->string('name');
			$table->boolean('completed');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('projects');
	}

}
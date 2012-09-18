<?php

class Create_Jobs_Table {

	public function up()
	{
		Schema::create('jobs', function($table) {
			$table->increments('id');
			$table->integer('project_id');
			$table->string('name');
			$table->boolean('completed');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('jobs');
	}

}
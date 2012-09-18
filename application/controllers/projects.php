<?php

class Projects_Controller extends Base_Controller {

	public $restful = true;

	public function get_index()
	{
		$projects = Project::all();

		return eloquent_to_json($projects);
	}

	public function get_show($id)
	{
		$project = Project::find($id);

		return eloquent_to_json($project);
	}

	public function post_create()
	{
		$input = Input::json();

		$project = Project::create(array(
			'name' => $input->name,
			'client_id' => $input->client_id,
			'completed' => $input->completed
		));

		return json_encode($project);
	}

	public function put_update($id)
	{
		$input = Input::json();

		$project = Project::find($id);

		$project->name = $input->name;
		$project->client_id = $input->client_id;
		$project->completed = $input->completed;
		$project->save();

		return json_encode($project);
	}

	public function get_project_jobs($id) {

		$project_jobs = Client::find($id)->jobs;

		return eloquent_to_json($project_jobs);
	}
}
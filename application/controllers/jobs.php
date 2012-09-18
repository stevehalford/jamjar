<?php

class Jobs_Controller extends Base_Controller {

	public $restful = true;

	public function get_index()
	{
		$jobs = Job::all();

		return eloquent_to_json($jobs);
	}

	public function get_show($id)
	{
		$job = Job::find($id);

		return eloquent_to_json($job);
	}

	public function post_create()
	{
		$input = Input::json();

		$job = Job::create(array(
			'name' => $input->name,
			'project_id' => $input->project_id,
			'completed' => $input->completed
		));

		return json_encode($job);
	}

	public function put_update($id)
	{
		$input = Input::json();

		$job = Job::find($id);

		$job->name = $input->name;
		$job->project_id = $input->project_id;
		$job->completed = $input->completed;
		$job->save();

		return json_encode($job);
	}

}
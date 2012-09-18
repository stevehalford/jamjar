<?php

class Clients_Controller extends Base_Controller {

	public $restful = true;

	public function get_index()
	{
		$clients = Client::all();

		return eloquent_to_json($clients);
	}

	public function get_show($id)
	{
		$client = Client::find($id);

		return eloquent_to_json($client);
	}

	public function post_create()
	{
		$input = Input::json();

		$client = Client::create(array(
			'name' => $input->name
		));

		return json_encode($client);
	}

	public function put_update($id)
	{
		$input = Input::json();

		$client = Client::find($id);

		$client->name = $input->name;
		$client->save();

		return json_encode($client);
	}

	public function get_client_projects($id) {

		$client_projects = Client::find($id)->projects;

		return eloquent_to_json($client_projects);
	}

}
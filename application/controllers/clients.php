<?php

class Clients_Controller extends Base_Controller {

	public $restful = true;

	public function get_index()
	{
		$clients = Client::all();

		return eloquent_to_json($clients);
	}

	public function get_show()
	{

	}

	public function post_create()
	{
		$input = Input::json();

		$client = Client::create(array(
			'name' => $input->name
		));

		return json_encode($client);
	}

	public function put_edit()
	{

	}

}
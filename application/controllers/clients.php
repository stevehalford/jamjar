<?php

class Clients_Controller extends Base_Controller {

	public $restful = true;

	public function get_index()
	{
		$tmp = array('name'=>'Steve Halford');

		return json_encode($tmp);
	}

	public function get_show()
	{

	}

	public function post_create()
	{

	}

	public function put_edit()
	{

	}

}
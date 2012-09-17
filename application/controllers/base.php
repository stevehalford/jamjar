<?php

class Base_Controller extends Controller {

	/**
	 * Catch-all method for requests that can't be matched.
	 *
	 * @param  string    $method
	 * @param  array     $parameters
	 * @return Response
	 */
	public function __call($method, $parameters)
	{
		return Response::error('404');
	}

	public function __construct() {
		//require auth for every controller except login
	    //$this->filter('before', 'auth')->except(array('login'));

	    //Assets
        Asset::add('jquery', 'js/jquery.min.js');
	    Asset::add('bootstrap-js', 'bootstrap/js/bootstrap.min.js');
        Asset::add('style', 'css/compiled/style.css');

        parent::__construct();
	}
}
<?php

namespace Dragoon\Bootstrap;

use Dragoon\Bootstrap\Kernel;
use Symfony\Component\HTTPFoundation\Request;

//This is the Composer that understands the Macro Template/DSL

class Router{

	protected $kernel;

	public function __construct (Kernel $kernel) {

		$this->kernel = $kernel;

	}

	//in the future, we can have a generic request object representing any kind of encoded message, pass this down the middleware stack
	public function routeHttp (Request $request) {

		//take the request's path
		//and route through a particular stack


		//this neeeds to return the response object

	}

	public function routeWs () {

		//route web socket objects

	}

}
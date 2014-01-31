<?php

namespace Dragoon\Bootstrap;

use Dragoon\Bootstrap\Kernel;

class Router{

	protected $kernel;

	public function __construct(Kernel $kernel){

		$this->kernel = $kernel;

	}

	protected function register($router){

		//outer to inner
		$this->loader->middleware([
			'Yearbook\Middleware\Output'
		]);

		//BIG PROBLEM WITH KLEIN: (simultaneous route matching)
		//respond to all! (but there's no terminate upon first match) SEE: https://github.com/chriso/klein.php/issues/156
		$router->respond($this->controller('Yearbook\Controllers\Home'));

		$router->dispatch();

	}

	protected function controller($controller, array $middleware = null){

		return function($request_parameters) use ($controller, $middleware){

			$this->loader->kernel($controller, $request_parameters, $middleware);

		};

	}

}

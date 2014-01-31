<?php

//This kernel will be building up the stack of middleware, it also requires the loader
//The router is one that needs this thing.

namespace Dragoon\Bootstrap;

use Dragoon\Bootstrap\Loader;

class Kernel{

	public function __construct(Loader $loader){


	}

}
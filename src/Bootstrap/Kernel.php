<?php

//This kernel will be building up the stack of middleware, it also requires the loader
//The router is one that needs this thing.
//the kernel is a MONAD!
//MONAD!!!!
//the middleware pipeline are functions that receive a type and outputs the same type
//this allows types to be pipelined one after the another
//in fact whole kernels and controllers can be piped one after another
//this type could be called "Task" that contains the ->request and ->response property
//One big lambda encapsulates this process, and this lambda converts a Request to Task type, and receives a Task type and outputs a Response type.
//This should mean that there's no difference between Controllers and Middleware, except in most cases, Middleware might simply modify the request or modify the response, rather than making the whole response

namespace Dragoon\Bootstrap;

use Dragoon\Bootstrap\Loader;

class Kernel{

	public function __construct(Loader $loader){


	}

}
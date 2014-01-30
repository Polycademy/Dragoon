<?php

//the bootstrap will load the pimple IOC
//Which will bring in all the configuration, and all of the controllers, modules, libraries
//Bootstrap can also bring in any secrets..?
//Since the configuration will be stored inside Pimple's IOC array, this can then be inserted into any controllers that require it

//also pass any the monolog instances here, to classes that will use logging


//THE LOADER is one that loads all the configuration. This can then be injected into all of the controllers or modules or libraries.

//NOTE THAT the Router is separated from the loader. The Router uses the loader. That is the Loader is passed as a dependency to the Router.

//THE LOADER also creates the middleware stack which is then injected into the router to be managed.

$loader['logger'] = $loader->share(function($c){
	//get the logger object with the Monolog
});

//it becomes possible to do this: throw $error() no longer throw new Exception or it could be possible to do like Modules\Error::create()
$loader['error'] = function($message = null, $code = 0, $previous = null) use ($loader){
	return new Dragoon\Modules\Error($message, $code, $previous, $loader['logger']);
};
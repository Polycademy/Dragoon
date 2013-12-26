<?php

try{

	//application environment defaults to development, or it can be extracted from SERVER_ENV
	define('ENVIRONMENT', isset($_SERVER['SERVER_ENV']) ? $_SERVER['SERVER_ENV'] : 'development');

	//Error Reporting
	error_reporting(E_ALL);

	//Composer autoloader
	require '../../vendor/autoload.php';

	//PSR-4 Autoloader
	require '../Bootstrap/Autoloader.php';
	$autoloader = new Autoloader;
	$autoloader->register();
	$autoloader->addNamespace('Dragoon', __DIR__ . '/../');

	//Dependency Injection and IOC
	require '../Bootstrap/Loader.php';

	//then load in the bootstrapper and establish the configuration that will be needed, such as global variables like $_ENV, the bootstrap would also use the configuration to and establish the storage adapters for usage for the models that require database access

	//then load the router, and pass the IOC into the router like new Router($ioc)
	//the router would use the IOC to establish the controllers to any routes, it will also establish the stack, and have configured a default stack, along with any specific stacks to use for the application

}catch(Exception $e){

	var_dump($e->getMessage);
	var_dump($e->getTraceAsString());

}
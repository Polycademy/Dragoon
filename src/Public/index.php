<?php

try{

	//application environment defaults to development, or it can be extracted from SERVER_ENV
	define('ENVIRONMENT', isset($_SERVER['SERVER_ENV']) ? $_SERVER['SERVER_ENV'] : 'development');

	//have some error reporting code here... (how should errors be reported)
	error_reporting(E_ALL);

	//bring in Composer autoloader
	require '../../vendor/autoload.php';

	//PSR-4 Autoloader (temporary until Composer has it's own PSR-4 autoloader)
	require '../Bootstrap/Autoloader.php';
	$autoloader = new Autoloader;
	$autoloader->register();
	$autoloader->addNamespace('Dragoon', __DIR__ . '/../');

	//Initialising Default Configuration
	$initialise = new Dragoon\Bootstrap\Initialise;

	//IOC Container
	$loader = new Dragoon\Bootstrap\Loader;

	//Kernel
	$kernel = new Dragoon\Bootstrap\Kernel($loader);

	//router
	$router = new Dragoon\Bootstrap\Router($kernel);

}catch(Exception $e){

	var_dump($e->getMessage);
	var_dump($e->getTraceAsString());

}
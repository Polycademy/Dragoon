<?php

try{	

	require '../../vendor/autoload.php';

	$kernel = Dragoon\Bootstrap\Initialise::init();
	
	$router = new Dragoon\Bootstrap\Router($kernel);

	$httpRequest = Symfony\Component\HTTPFoundation\Request::createFromGlobals();
	
	$httpResponse = $router->routeHttp($httpRequest);
	$httpResponse->prepare();
	$httpResponse->send();

}catch(Exception $e){

	var_dump($e->getMessage);
	var_dump($e->getTraceAsString());

}
<?php

//application environment defaults to development, or it can be extracted from SERVER_ENV
define('ENVIRONMENT', isset($_SERVER['SERVER_ENV']) ? $_SERVER['SERVER_ENV'] : 'development');

//have some error reporting code here... (how should errors be reported)

//bring in Composer autoloader
require 'vendor/autoload.php';

//then load in the bootstrapper and establish the configuration that will be needed, such as global variables like $_ENV, the bootstrap would also use the configuration to and establish the storage adapters for usage for the models that require database access

//then load the router, and pass the IOC into the router like new Router($ioc)
//the router would use the IOC to establish the controllers to any routes, it will also establish the stack, and have configured a default stack, along with any specific stacks to use for the application
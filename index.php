<?php

//application environment defaults to development, or it can be extracted from SERVER_ENV
define('ENVIRONMENT', isset($_SERVER['SERVER_ENV']) ? $_SERVER['SERVER_ENV'] : 'development');

//bring in Composer autoloader
require 'vendor/autoload.php';
<?php

namespace Dragoon\Bootstrap;

use Patchwork\Utf8\Bootup as Utf8;
use Dragoon\Bootstrap\Config;
use Dragoon\Bootstrap\Loader;
use Dragoon\Bootstrap\Kernel;

/**
 * Initialise the Application.
 */
class Initialise{

    public static function init () {

        //configuring PHP for utf-8
        Utf8::initAll();

        //load the configuration
        $config = new Config;

        //error level
        error_reporting(constant($config->get('error_level'))); //should be E_ALL

        //php runtime configuration (ini set)
        self::runtimeConfig($config);

        //timezone
        date_default_timezone_set($config->get('timezone')); //should be UTC

        //IOC Container
        $loader = new Loader;

        //Middleware Kernel
        $kernel = new Kernel($loader);

        return $kernel;
        
    }

    protected static function runtimeConfig (Config $config) {

        //take the config, and set the PHP runtime settings

        //some settings should not be set if the SAPI is CLI, like max execution time, or any of the limits

    }

}
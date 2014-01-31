<?php

/**
 * Initial configuration for the PHP runtime. This can be used for ini_set(), timezones and UTF-8 configuration
 */
class Initialise{

    public static function init(){

        //configuring PHP for utf-8
        \Patchwork\Utf8\Bootup::initAll();
        \Patchwork\Utf8\Bootup::filterRequestUri(); //redirects to an UTF-8 encoded URL if it's not already the case
        \Patchwork\Utf8\Bootup::filterRequestInputs(); //normalizes HTTP inputs to UTF-8 NFC

        //timezone
        date_default_timezone_set('UTC');
        
    }

}
<?php

/*
Initial configuration for the PHP runtime
Such as global ini_set.. default timezone.. etc
 */
class Initialise{

    public function __construct(){

        //default character set
        ini_set('default_charset', 'utf-8');

        //locale settings see http://lh.2xlibre.net/locales/ for a list of locales
        //for some locales, this can change the decimal separator to a comma, which is not supported by SQL databases
        //use an adapter or wrapping function prior to entry into a database to make comma decimals into dot decimals
        set_locale(LC_ALL, 'en_us');

        //timezone
        date_default_timezone_set('UTC');


        
        

        // //multibyte character encoding
        // if(extension_loaded('mbstring')){
        //  mb_internal_encoding('UTF-8');
        //  mb_regex_encoding('UTF-8');
        //  mb_http_output('UTF-8');
        //  mb_language('uni');
        // }

        // //iconv character encoding (iconv is not an extension)
        // if(function_exists('iconv')){
        //  iconv_set_encoding('internal_encoding', 'UTF-8');
        //  iconv_set_encoding('output_encoding', 'UTF-8');
        //  iconv_set_encoding('input_encoding', 'UTF-8');
        // }

    }

}
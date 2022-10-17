<?php

class Autoloader
{
    
    static function register()
    {
        spl_autoload_register([
            __CLASS__,
            'autoload'
        ]);
    }

    static function autoload($class)
    {
        $class = str_replace('App' . '\\', '', $class);
        $class = str_replace('\\', '/', $class);
        if (file_exists('src/' . $class . '.php')) {
            require_once 'src/' . $class . '.php';
        }
    }
}
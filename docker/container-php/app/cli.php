<?php

class cli 
{
    static function run()
    {
        // add autoload
        spl_autoload_register("cli::autoload");

        // run test
        xp_cli::test();

    }

    static function autoload ()
    {
        // autoload classes
        spl_autoload_register(function ($class_name) {
            $file = __DIR__ . "/class/" . $class_name . ".php";
            if (file_exists($file)) {
                require_once $file;
            }
        });
    }
}

cli::run();
<?php

class cli 
{
    static $kv = [];

    static function run()
    {
        static::kv("root", __DIR__ );
        
        // add autoload
        spl_autoload_register("cli::autoload");

        // check if file my-config.php exists
        // then load it
        if (file_exists(__DIR__ . "/my-config.php")) {
            require_once __DIR__ . "/my-config.php";
        }

        // run tasks
        xp_task::work();
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

    static function kv ($key, $value = null)
    {
        if ($value) {
            static::$kv[$key] = $value;
        }
        else {
            return static::$kv[$key] ?? "";
        }
    }
}

cli::run();
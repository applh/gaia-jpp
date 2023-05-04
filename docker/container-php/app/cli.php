<?php

class cli 
{
    static $kv = [];

    static function run()
    {
        static::kv("root", __DIR__ );
        static::kv("path_class", __DIR__ . "/class");
        static::kv("path_data", __DIR__ . "/my-data");
        
        // add autoload
        spl_autoload_register("cli::autoload_file");
        spl_autoload_register("cli::autoload_zip");

        // check if file my-config.php exists
        // then load it
        if (file_exists(__DIR__ . "/my-config.php")) {
            require_once __DIR__ . "/my-config.php";
        }

        // run tasks
        xp_task::work();
    }

    static function autoload_file ($classname)
    {
        // autoload classes
        $path_class = cli::kv("path_class");
        $file = "$path_class/" . $classname . ".php";
        if (file_exists($file)) {
            require_once $file;
        }
    }

    static function autoload_zip ($classname)
    {
        $path_data = cli::kv("path_data"); 
        $target_file = "$path_data/class/$classname.php";
        // check if $target_file exists then include it
        if (file_exists($target_file)) {
            require_once $target_file;
            return;
        }

        $path_zip = "$path_data/class.zip";
        $path_class = "zip://$path_zip#class/$classname.php";
        if (file_exists($path_zip)) {
            // copy the file to $path_data/class/$classname.php
            $code = file_get_contents($path_class);
            file_put_contents($target_file, $code);
            require_once $target_file;
        }
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
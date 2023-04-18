<?php

class gaia_cli
{
    static function run ()
    {
        // register autoloader
        spl_autoload_register("gaia_cli::autoload");

        // router
        if (is_callable("gaia_web::server")) {
            // entry from public/index.php
            xp_server::run();
        }
        else {
            // entry point from cli.php
            xp_cli::run();
        }
    }

    static function autoload ($class)
    {
        $file = __DIR__ . "/class/" . str_replace("\\", "/", $class) . ".php";
        if (file_exists($file)) {
            require $file;
        }
    }
}

gaia_cli::run();
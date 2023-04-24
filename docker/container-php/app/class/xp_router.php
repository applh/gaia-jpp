<?php

class xp_router 
{
    static $filename = "";
    static $routes = [];

    static function request ()
    {
        // check if called from cli or index::web
        if (is_callable("index::web")) {
            // web server mode
            $uri = $_SERVER['REQUEST_URI'] ?? "";
            extract(parse_url($uri));

            $path ??= "/index.php";
            $path_infos = (pathinfo($path));
            // print_r($path_infos);
            extract($path_infos);
            $filename ??= "index";

            static::$filename = $filename;
            // echo "filename: $filename\n$path\n";

            $route = static::$routes[$filename] ?? "";
            if ($route) {
                // add task 
                xp_task::add($filename, $route);
            }

        }
        else {
            // cli mode
            xp_task::add("cli", "xp_cli::run");
        }
    }
    static function add ($key, $cmd)
    {
        $key = trim($key);
        if ($key != "") {
            static::$routes[$key] = $cmd;
        }
    }

}
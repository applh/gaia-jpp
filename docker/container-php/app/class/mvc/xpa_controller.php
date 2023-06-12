<?php

/**
 * xpa_controller
 * 
 * created: 2023-05-25 17:12:21
 * author: applh/gaia
 * license: MIT
 */

/**
 * xpa_controller
 * FIXME: cache duplicate when mix WP + GAIA ?!
 */
class xpa_controller
{
    //#class_start
    static $cache_active = true;

    static function cache_read($prefix="")
    {
        if (xpa_controller::$cache_active) {
            // check if cache exists
            $uri = $_SERVER["REQUEST_URI"];
            extract(parse_url($uri));
            $path = trim($path ?? "/", "/");
            xpa_os::cache_send("$prefix$path");
        }
    }

    static function cache_start()
    {
        if (xpa_controller::$cache_active) {
            // header("X-Debug-Cache: true");
            ob_start();
        }
    }

    static function run()
    {
        // TODO: process request infos
        // show xpa_os::$tasks
        // print_r(xpa_os::$tasks);
    }

    static function cache_end($prefix="")
    {
        if (xpa_controller::$cache_active) {
            $uri = $_SERVER["REQUEST_URI"];
            extract(parse_url($uri));
            $path = trim($path ?? "/", "/");

            $response = ob_get_clean();
            // header("X-Debug-Cache-Path: $path");
            
            if ($response) {
                // save response in cache file
                xpa_os::cache_save("$prefix$path", $response);
            }
            echo $response;
        }
    }

    //#class_end
}

//#file_end
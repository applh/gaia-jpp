<?php

/**
 * Plugin Name: XP Studio
 */

if (!function_exists('add_action')) {
    exit;
}

class xp_studio
{
    static function setup()
    {
        // add autoload function
        spl_autoload_register("xp_studio::autoload");

        // add init callback
        // WARNING: WP will throw an error if the callback is not callable
        if (is_callable("xps_action::init")) {
            add_action("init", "xps_action::init");
        }
    }

    static function autoload($classname)
    {
        xp_studio::autoload_dir($classname);
        if (!class_exists($classname)) {
            xp_studio::autoload_zip($classname);
        }
    }

    static function autoload_dir ($classname)
    {
        // look in the class folder
        $filename = __DIR__ . "/class/$classname.php";
        if (file_exists($filename)) {
            include_once $filename;
        }
    }

    static function autoload_zip($classname)
    {
        // if the zip archive my-class.zip exists
        // check if file with name class/$classname.php exists
        // then extract the file in my-data folder with special name class-md5($classname).php
        // and include the file
        // else check if file with name class/$classname.php exists
        // and include the file
        $found = false;
        $md5 = md5($classname);
        $filename = "class-$md5.php";
        $cache_file = __DIR__ . "/my-data/$filename";
        if (file_exists($cache_file)) {
            include_once $cache_file;
            $found = true;
        }
        $zip_archive = __DIR__ . '/my-data/class.zip';
        if (!$found && file_exists($zip_archive)) {
            $zip = new ZipArchive;
            if ($zip->open($zip_archive) === TRUE) {
                $src_class = "class/$classname.php";
                $content = $zip->getFromName($src_class);
                if ($content !== false) {
                    file_put_contents($cache_file, $content);
                    include_once "my-data/$filename";
                    $found = true;
                }
                $zip->close();
            }
        } 
        if (!$found && file_exists("class/$classname.php")) {
            include_once "class/$classname.php";
        }
    }
}

xp_studio::setup();

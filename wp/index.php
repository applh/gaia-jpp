<?php

/**
 * Plugin Name: gaia-jpp
 */

if (!function_exists('add_action')) die();

class gaia_jpp
{
    static function init()
    {
        // add autoload
        spl_autoload_register("gaia_jpp::autoload");

        // add plugins_loaded action
        add_action("plugins_loaded", "xp_action::plugins_loaded");

        // add admin menu in plugins
        add_action("admin_menu", "xp_action::admin_menu");
    }
    
    static function autoload($class)
    {
        $class = str_replace("\\", "/", $class);
        $file = __DIR__ . "/class/$class.php";
        if (file_exists($file)) {
            include $file;
        }
    }
}

gaia_jpp::init();
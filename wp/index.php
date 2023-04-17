<?php

/**
 * Plugin Name: gaia-jpp
 */

if (!function_exists('add_action')) die();

class gaia_jpp
{
    static function init()
    {
        // add admin menu in plugins
        add_action("admin_menu", "gaia_jpp::admin_menu");
    }

    static function admin_menu()
    {
        // add submenu in plugins
        add_plugins_page(
            "gaia-jpp", 
            "gaia-jpp",
             "manage_options", 
             "gaia-jpp", 
             "gaia_jpp::admin_page"
        );
    }

    static function admin_page()
    {
        include __DIR__ . "/admin.php";
    }
}

gaia_jpp::init();
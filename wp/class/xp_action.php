<?php

class xp_action
{
    static function plugins_loaded()
    {
        // https://developer.wordpress.org/reference/hooks/

        // register blocks before init 
        // as blocks are using init hook also
        xp_action::register_blocks();
        
        // add block
        add_action("init", "xp_action::init");
    }

    static function register_blocks ()
    {
        // register block in folder myblock/
        include dirname(__DIR__) . "/myblock/myblock.php";

    }

    static function init () 
    {
    }

    static function admin_menu()
    {
        // add submenu in plugins
        add_plugins_page(
            "gaia-jpp", 
            "gaia-jpp",
             "manage_options", 
             "gaia-jpp", 
             "xp_action::admin_page"
        );
    }

    static function admin_page()
    {
        include dirname(__DIR__) . "/admin.php";
    }
    
}
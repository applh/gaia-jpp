<?php

class xpa_page 
{
    static function index ()
    {
        // find template file
        $template = cli::kv("root") . "/templates/index.php";
        if (file_exists($template)) {
            // allow gaia cms mix with others cms
            xpa_router::$response_status = "200";
            require_once $template;
        }
        else {
            echo "template not found ($template)";
        }
    }

    static function api ()
    {
        // find template file
        $template = cli::kv("root") . "/templates/api.php";
        if (file_exists($template)) {
            // allow gaia cms mix with others cms
            xpa_router::$response_status = "200";
            require_once $template;
        }
        else {
            echo "template not found ($template)";
        }
    }

    static function admin ()
    {
        $path_root = cli::kv("root");
        $path_templates = $path_root . "/templates";
        $path_vue = $path_templates . "/vue.php";
        
        // if template file exists then use it
        if (file_exists($path_vue)) {
            // allow gaia cms mix with others cms
            xpa_router::$response_status = "200";
            require_once $path_vue;
        }
        else {
            echo "template not found ($path_vue)";
        }
    }

    // static function app ()
    // {
    //     $path_root = cli::kv("root");
    //     $path_templates = $path_root . "/templates";
    //     $path_vue = $path_templates . "/vue.php";
        
    //     // if template file exists then use it
    //     if (file_exists($path_vue)) {
    //         // allow gaia cms mix with others cms
    //         xpa_router::$response_status = "200";
    //         require_once $path_vue;
    //     }
    //     else {
    //         echo "template not found ($path_vue)";
    //     }
    // }

    /**
     * robots.txt
     */
    static function robots ()
    {
        // allow gaia cms mix with others cms
        xpa_router::$response_status = "200";

    }

}
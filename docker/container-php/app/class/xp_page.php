<?php

class xp_page 
{
    static function index ()
    {
        // find template file
        $template = cli::kv("root") . "/templates/index.php";
        if (file_exists($template)) {
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
            require_once $template;
        }
        else {
            echo "template not found ($template)";
        }
    }
}
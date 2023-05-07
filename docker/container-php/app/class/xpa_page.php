<?php

class xpa_page 
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

    static function admin ()
    {
        echo "admin page";
    }

    static function member ()
    {
        echo "member page";
        $callback = "xpdb::test";
        if (is_callable($callback)) {
            echo "HELLO";
            $callback();
        }
        else {
            echo "NOT CALLABLE";
        }

        // print_r(xpa_router::$json);

    }

}